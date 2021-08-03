<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';

    $studentID = $_SESSION['STUDENT_ID'];
    $admission = $selectObj->getAdmissionInformationByID($studentID);

    $schoolYear = $selectObj->getControl('enrollment-school-year');
    $semester = $selectObj->getControl('enrollment-semester');

    $tuitionFee = 0;
    $miscFee = 0;
    $totalUnits = 0;
    $amountPaid = 0;

    $student = $selectObj->getStudentByID($studentID);
    $address = $selectObj->getAddressByID($studentID);
    $course = $selectObj->getCourseByCourse($admission['PreferredCourse']);

    $academicInfo = $selectObj->getStudentAcademicInformationByStudentID($studentID);
    $subjects = $selectObj->getStudentClassByStudentIDSchoolYearSemester($studentID, $schoolYear, $semester);
    $misc = $selectObj->getMiscellaneousByAcademicInfo($course['CourseID'], $academicInfo['YearLevel'], $academicInfo['Semester']);
?>

<link rel="stylesheet" href="../css/enrollment.encoded-subject.css?v=<?php echo time()?>">

<input type="hidden" id="academic-id" value="<?php echo $academicInfo['AcademicID'];?>">
<input type="hidden" id="admission-id" value="<?php echo $admission['AdmissionID']?>">
<input type="hidden" id="residency" value="<?php echo $address['Residency']?>">
<input type="hidden" id="student-id" value="<?php echo $studentID?>">

<div class="container py-3">
    <?php 
        if(isset($_SESSION['TYPE'])){
            $oldEnrollmentStatus = $selectObj->getOldStudentEnrollmentByStudentIDSChoolYear($_SESSION['STUDENT_ID'], $schoolYear);
            if($oldEnrollmentStatus['EnrollmentStatus'] == "to encode"){
                echo '<h1 class="sub-header text-center">Your Subjects are currently on process. Refresh your browser every minute to check you Subjects</h1>';
            }
        }
    ?>

    <div class="outer-container border">
        <div class="subject-enlist p-2">
            <p class="sub-header text-center m-0">Pamantasan ng Lungsod ng Marikina</p>
            <p class="phar text-center m-0">Brazil St., Greenheights Subdivision, Marikina, 1800 Metro Manila</p>
            <p class="title text-center m-0">Registration and Assessment Form</p>
            <p class="title m-0 text-center">SY <?php echo $schoolYear;?></p>

            <!-- Student Information -->
            <div class="row mt-4 mx-2">
                <div class="col-6">
                    <table>
                        <tr>
                            <td class="phar">Student ID:</td>
                            <td class="title"><?php echo $student['StudentID']?></td>
                        </tr>
                        <tr>
                            <td class="phar">Name:</td>
                            <td class="title"><?php echo $student['Lastname'] . ", " . $student['Firstname'] . " " . $student['Middlename']?></td>
                        </tr>
                        <tr>
                            <td class="phar">Gender:</td>
                            <td class="title"><?php echo $student['Gender']?></td>
                        </tr>
                        <tr>
                            <td class="phar">Residency:</td>
                            <td class="title"><?php echo $address['City']?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-6">
                    <table>
                        <tr>
                            <td class="phar">Course:</td>
                            <td class="title"><?php echo $course['Course']?></td>
                        </tr>
                        <tr>
                            <td class="phar">Year Level:</td>
                            <td class="title"><?php echo $academicInfo['YearLevel']?></td>
                        </tr>
                        <tr>
                            <td class="phar">Semester:</td>
                            <td class="title"><?php echo $semester;?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Subjects -->
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
                    <?php for($i = 0; $i < count($subjects); $i++): ?>
                        <?php
                            $tuitionFee += $subjects[$i]['SubjectFee'];
                            $totalUnits += $subjects[$i]['Units'];
                        ?>
                        <tr>
                            <td><?php echo $subjects[$i]['SubjectCode']?></td>
                            <td><?php echo $subjects[$i]['Description']?></td>
                            <td><?php echo $subjects[$i]['Day'] . " " . $subjects[$i]['Time']?></td>
                            <td><?php echo $subjects[$i]['Units']?></td>
                            <td><?php echo $subjects[$i]['SubjectFee']?></td>
                        </tr>
                    <?php endfor; ?>
                        <tr>
                            <td colspan="5" class="text-center">Total Units: <?php echo $totalUnits?></td>
                        </tr>
                </tbody>
            </table>

            <!-- Miscellaneous -->
            <div class="row">
                <div class="col-4">
                    <table class="misc-fee">
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
                    <table class="misc-fee">
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
                    <table class="misc-fee">
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

            <!-- Fee Details -->
            <?php if($address['Residency'] == "non-marikina"):?>
                <table class="mt-5 fee-details">
                    <tr>
                        <td>Tuition Fee:</td>
                        <td>₱ <?php echo $tuitionFee?></td>
                    </tr>
                    <tr>
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
                <table class="mt-5 fee-details">
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
    </div>
    
    <div class="d-flex justify-content-end mt-3">
        <button class="plmar-btn mx-3" onclick="window.location.replace('../php/CancelEnrollment.php')">Cancel</button>

        
    <?php 
        if(isset($_SESSION['TYPE'])){
            $oldEnrollmentStatus = $selectObj->getOldStudentEnrollmentByStudentIDSChoolYear($_SESSION['STUDENT_ID'], $schoolYear);
            if($oldEnrollmentStatus['EnrollmentStatus'] == "to encode"){}
            else{
                echo '<button class="plmar-btn mx-3" data-bs-toggle="modal" data-bs-target="#modal-payment-options">Proceed to Payment</button>';
            }
        }
        else{
            echo '<button class="plmar-btn mx-3" data-bs-toggle="modal" data-bs-target="#modal-payment-options">Proceed to Payment</button>';
        }
    ?>
    </div>
</div>

<input type="hidden" id="tuition-fee" value="<?php echo $tuitionFee?>">
<input type="hidden" id="misc-fee" value="<?php echo $miscFee?>">

<div class="modal fade" id="modal-payment-options">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="phar mb-0">Choose a payment mode</p>
                <ul>
                    <li><input type="radio" name="payment-mode" id="install" value="Installment" <?php echo ($address['Residency'] == "marikina") ? "disabled" : "checked"?>> <label for="install" class="title">Installment</label></li>
                    <li><input type="radio" name="payment-mode" id="full-pay" value="Full Payment" <?php echo ($address['Residency'] == "marikina") ? "checked" : ""?>> <label for="full-pay" class="title">Full Payment</label></li>
                    <li class="option-display">
                        <?php if($address['Residency'] == "marikina"): ?>
                            <div id="full-payment">
                                <table class="modal-disp-details">
                                    <tr>
                                        <td>Total Amount: </td>
                                        <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                                    </tr>
                                    <tr>
                                        <td>Residency Discount: </td>
                                        <td>₱ <?php echo 300 - ($miscFee + $tuitionFee)?></td>
                                    </tr>
                                    <tr>
                                        <td>Balance: </td>
                                        <td>₱ 300</td>
                                        <?php $amountPaid = 300; ?>
                                    </tr>
                                </table>
                            </div>
                        <?php else: ?>
                            <div id="full-payment">
                                <table class="modal-disp-details">
                                    <tr>
                                        <td>Total Amount: </td>
                                        <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                                    </tr>
                                    <tr>
                                        <td>Full Payment Discount(20%): </td>
                                        <td>₱ -<?php echo (($miscFee + $tuitionFee) * .20)?></td>
                                    </tr>
                                    <tr>
                                        <td>Balance: </td>
                                        <td>₱ <?php echo ($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20)?></td>
                                        <?php $amountPaid = ($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20); ?>
                                    </tr>
                                </table>
                            </div>
                            <div id="installment">
                                <table class="modal-disp-details">
                                    <tr>
                                        <td>Total Amount: </td>
                                        <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                                    </tr>
                                    <tr>
                                        <td>Downpayment(20%): </td>
                                        <td>₱ <?php echo (($miscFee + $tuitionFee) * .20)?></td>
                                        <?php $amountPaid = (($miscFee + $tuitionFee) * .20); ?>
                                    </tr>
                                    <tr>
                                        <td>Midterm due: </td>
                                        <td>₱ <?php echo (($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20)) / 2?></td>
                                    </tr>
                                    <tr>
                                        <td>Finals due: </td>
                                        <td>₱ <?php echo (($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20)) / 2?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="plmar-btn" id="btn-submit-payment">Submit Payment Details</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="amount-paid" value="<?php echo $amountPaid?>">
<script src="../js/enrollment.encoded-subject.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>