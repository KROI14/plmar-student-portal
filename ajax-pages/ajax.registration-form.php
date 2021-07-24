<?php
    session_start();
    include '../includes/classloader.php';
    $selectObj = new Select();
    
    $schoolYear = $selectObj->getControl('enrollment-school-year');
    
    $student = $selectObj->getStudentByID($_POST['student-id']);
    $address = $selectObj->getAddressByID($_POST['student-id']);
    $academicInfo = $selectObj->getStudentAcademicInfoByStudentAndSchoolYear($_POST['student-id'], $schoolYear);

    if(is_array($academicInfo)){
        $course = $selectObj->getCourseByCourseID($academicInfo['CourseID']);

        $subjects = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_POST['student-id'], $academicInfo['SchoolYear'], $academicInfo['Semester']);
        $misc = $selectObj->getMiscellaneousByAcademicInfo($academicInfo['CourseID'], $academicInfo['YearLevel'], $academicInfo['Semester']);

        $assessmentDue = $selectObj->getAssessmentDuesByAcademicID($academicInfo['AcademicID']);
        $officialDownpayment = $selectObj->getOfficialDownpaymentByAcademicID($academicInfo['AcademicID']);

        $miscFee = 0;
        $tuitionFee = 0;
        $totalUnits = 0;
    }
?>
<style>
    .registration-form{
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: 1200px;
    }

    .registration-form table.info-details tr td{
        font-size: 14px;
        padding-top: 3px;
    }

    .registration-form table.info-details tr td:nth-child(1){
        padding-right: 50px;
    }

    .registration-form table.subjects{
        font-size: 14px;
    }
</style>

<div class="registration-form">
    <h4 class="text-center m-0">Pamantasan ng Lungsod ng Marikina</h4>
    <p class="text-center m-0 form-text">Brazil St., Greenheights Subdivision, Marikina, 1800 Metro Manila</p>
    <p class="title text-center m-0">Registration and Assessment Form</p>
    <p class="title m-0 text-center">SY <?php echo $schoolYear?></p>

    <!-- Student Information -->
    <?php if(is_array($academicInfo)): ?>
        <div class="row mt-4">
            <div class="col-6">
                <table class="info-details">
                    <tr>
                        <td>Student ID:</td>
                        <td><?php echo $student['StudentID']?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $student['Lastname'] . ", " . $student['Firstname'] . " " . $student['Middlename']?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo $student['Gender']?></td>
                    </tr>
                    <tr>
                        <td>Residency:</td>
                        <td><?php echo $address['City']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table class="info-details">
                    <tr>
                        <td>Course:</td>
                        <td><?php echo $course['Course']?></td>
                    </tr>
                    <tr>
                        <td>Year Level:</td>
                        <td><?php echo $academicInfo['YearLevel']?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td><?php echo $academicInfo['Semester']?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <table class="table table-bordered mt-4 subjects">
        <thead>
            <tr>
                <th>Subject Code</th>
                <th>Description</th>
                <th>Schedule</th>
                <th>Total Units</th>
                <th>Subject Fee</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($academicInfo)): ?>
                <?php for($i = 0; $i < count($subjects); $i++): ?>
                    <tr>
                        <td><?php echo $subjects[$i]['SubjectCode']?></td>
                        <td><?php echo $subjects[$i]['Description']?></td>
                        <td><?php echo $subjects[$i]['Day'] , " " . $subjects[$i]['Time']?></td>
                        <td><?php echo $subjects[$i]['Units']?></td>
                        <td>₱ <?php echo $subjects[$i]['SubjectFee']?></td>
                    </tr>
                    <?php $tuitionFee += $subjects[$i]['SubjectFee']; ?>
                    <?php $totalUnits += $subjects[$i]['Units']; ?>
                <?php endfor?>
                <tr>
                    <td colspan="5" class="text-center">Total Units: <?php echo $totalUnits; ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if(is_array($academicInfo)): ?>
        <!-- Miscellaneous -->
        <div class="row">
            <div class="col-4">
                <table class="info-details">
                    <?php for($i = 0; $i <= 1; $i++): ?>
                        <tr>
                            <td><?php echo $misc[$i]['Miscellaneous']?></td>
                            <td>₱<?php echo $misc[$i]['Fee']?></td>
                        </tr>
                        <?php $miscFee += $misc[$i]['Fee']; ?>
                    <?php endfor ?>
                </table>
            </div>
            <div class="col-4">
                <table class="info-details">
                    <?php for($i = 2; $i <= 3; $i++): ?>
                        <tr>
                            <td><?php echo $misc[$i]['Miscellaneous']?></td>
                            <td>₱<?php echo $misc[$i]['Fee']?></td>
                        </tr>
                        <?php $miscFee += $misc[$i]['Fee']; ?>
                    <?php endfor ?>
                </table>
            </div>
            <div class="col-4">
                <table class="info-details">
                    <?php for($i = 4; $i <= 4; $i++): ?>
                        <tr>
                            <td><?php echo $misc[$i]['Miscellaneous']?></td>
                            <td>₱<?php echo $misc[$i]['Fee']?></td>
                        </tr>
                        <?php $miscFee += $misc[$i]['Fee']; ?>
                    <?php endfor ?>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6 mt-3">
                <!-- Fee Details -->
                <?php if($address['Residency'] == "non-marikina"):?>
                    <table class="info-details">
                        <tr>
                            <td>Tuition Fee:</td>
                            <td>₱ <?php echo $tuitionFee?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid black">
                            <td>Miscellaneous Fee:</td>
                            <td>₱ <?php echo $miscFee?></td>
                        </tr>
                        <tr>
                            <td>Total Assessment Fee:</td>
                            <td>₱ <?php echo $tuitionFee + $miscFee?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td>₱ <?php echo $tuitionFee + $miscFee?></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table class="info-details">
                        <tr>
                            <td>Tuition Fee:</td>
                            <td>₱<?php echo $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous Fee:</td>
                            <td>₱<?php echo $miscFee ?></td>
                        </tr>
                        <tr>
                            <td>Total Assessment Fee:</td>
                            <td>₱<?php echo $miscFee + $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Residency Discount:</td>
                            <td>₱<?php echo 300 - ($miscFee + $tuitionFee);?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td>₱300</td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <table class="info-details">
                    <tr>
                        <td>Payment Mode: </td>
                        <td><?php echo $officialDownpayment['PaymentMode']?></td>
                    </tr>
                    <?php if($address['Residency'] == "marikina" || $officialDownpayment['PaymentMode'] == "Full Payment"): ?>
                        <tr>
                            <td>Payment: </td>
                            <td>₱ <?php echo $officialDownpayment['AmountPaid']?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>Downpayment: </td>
                            <td>₱ <?php echo $officialDownpayment['AmountPaid']?></td>
                        </tr>
                    <?php endif; ?>
                    <!-- <tr>
                        <td>Date Paid: </td>
                        <td><?php echo $officialDownpayment['DatePaid']?></td>
                    </tr> -->
                    <tr>
                        <td class="pt-2 title">Midterm Due: </td>
                        <td class="pt-2 title">₱ <?php echo $assessmentDue[0]['TuitionFee'] + $assessmentDue[0]['MiscFee']?></td>
                    </tr>
                    <tr>
                        <td class="title">Final Due: </td>
                        <td class="title">₱ <?php echo $assessmentDue[1]['TuitionFee'] + $assessmentDue[1]['MiscFee']?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>