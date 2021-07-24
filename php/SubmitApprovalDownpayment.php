<?php

include '../includes/classloader.php';
session_start();

$insertObj = new Insert();
$selectObj = new Select();
$updateObj = new Update();

$approvalID = $selectObj->getIncrementedID('downpayment_approval', 'ApprovalID');

$res = $insertObj->setDownpaymentApproval($approvalID, $_POST['academic-id'], $_POST['payment-mode'], $_POST['bank'], $_FILES['payment-file'], "on process");

if(isset($_SESSION['TYPE'])){
    $updateObj->updateOldStudentEnrollmentStatus($_SESSION["STUDENT_ID"], "payment on process");
}

$updateRes = $updateObj->updateEnrollmentStatus("payment on process", $_POST['admission-id']);
if($res > 0){
    echo "success";
}