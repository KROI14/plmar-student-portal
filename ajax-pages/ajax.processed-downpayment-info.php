<?php
    include '../includes/classloader.php';
    $selectObj = new Select();

    $miscFee = 0;
    $tuitionFee = 0;

    $student = $selectObj->getStudentByID($_POST['student-id']);
    $address = $selectObj->getAddressByID($_POST['student-id']);

    $academicInfo = $selectObj->getStudentAcademicInformationByStudentID($_POST['student-id']);

    $admission = $selectObj->getAdmissionInformationByID($_POST['student-id']);
    
    $dpApproval = $selectObj->getDownpaymentApprovalByApprovalID($_POST['approval-id']);
    $class = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_POST['student-id'], $selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
    $misc = $selectObj->getMiscellaneousByAcademicInfo($academicInfo['CourseID'], $academicInfo['YearLevel'], $academicInfo['Semester']);

    foreach($class as $subject){
        $tuitionFee += $subject['SubjectFee'];
    }
    foreach($misc as $fees){
        $miscFee += $fees['Fee'];
    }
?>

<style>
    .name-img{
        overflow: hidden;
    }

    table.details tr td:nth-child(1){
        padding-right: 30px;
        padding-left: 12px;
    }
</style>

<input type="hidden" id="payment-mode" value="<?php echo $dpApproval['PaymentMode']?>">
<input type="hidden" id="academic-id" value="<?php echo $dpApproval['AcademicID']?>">
<input type="hidden" id="approval-id" value="<?php echo $_POST['approval-id']?>">
<input type="hidden" id="admission-id" value="<?php echo $admission['AdmissionID']?>">

<input type="hidden" id="tuition-fee" value="<?php echo $tuitionFee?>">
<input type="hidden" id="misc-fee" value="<?php echo $miscFee?>">
<input type="hidden" id="residency" value="<?php echo $address['Residency'];?>">

<div class="modal-header">
    <h5 class="modal-title">Submitted Payments</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="name-img">
        <img src="../user-uploads/<?php echo $student['Image']?>" width="100px" height="100px" class="rounded-circle float-start me-2">
        <p class="title mt-3 mb-0"><?php echo $student['Lastname'] . ", " . $student['Lastname'] . " " . $student['Middlename']?></p>
        <p class="phar mb-0"><?php echo $student['StudentID'];?></p>
        <p class="phar mb-0">Residency: <?php echo $address['City'] . "(" . $address['Residency'] . ")"?></p>
    </div>
        <div class="payment-details mt-3">
            <label class="title">Payment Details</label>
            <table class="details">
                <tr>
                    <td>Payment Mode:</td>
                    <td><?php echo $dpApproval['PaymentMode']?></td>
                </tr>
                <tr>
                    <td>Bank:</td>
                    <td><?php echo $dpApproval['Bank']?></td>
                </tr>
                <tr>
                    <td>Bank Transfer Receipt:</td>
                    <td><a href="../user-uploads/<?php echo $dpApproval['File']?>" download="<?php echo $dpApproval['Filename']?>"><?php echo $dpApproval['Filename']?></a></td>
                </tr>
            </table>
        </div>

        <div class="fee-details mt-3">
            <label class="title">Fee Details</label>
            <table class="details">
                <?php if($address['Residency'] == "non-marikina"): ?>
                    <?php if($dpApproval['PaymentMode'] == "Installment"): ?>
                        <tr>
                            <td>Total Amount: </td>
                            <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td class="title">Downpayment(20%): </td>
                            <td class="title">₱ <?php echo (($miscFee + $tuitionFee) * .20) ?></td>
                        </tr>
                        <tr>
                            <td>Midterm due: </td>
                            <td>₱ <?php echo (($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20)) / 2 ?></td>
                        </tr>
                        <tr>
                            <td>Finals due: </td>
                            <td>₱ <?php echo (($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20)) / 2 ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>Total Amount: </td>
                            <td>₱ <?php echo $miscFee + $tuitionFee ?></td>
                        </tr>
                        <tr>
                            <td>Full Payment Discount(20%): </td>
                            <td>₱ -<?php echo (($miscFee + $tuitionFee) * .20)?></td>
                        </tr>
                        <tr>
                            <td class="title">Balance: </td>
                            <td class="title">₱ <?php echo($miscFee + $tuitionFee) - (($miscFee + $tuitionFee) * .20) ?></td>
                        </tr>
                    <?php endif; ?>
                <?php else: ?>
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
                        </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>