<?php

session_start();
include '../includes/classloader.php';
$insertObj = new Insert();
$updateObj = new Update();
$selectObj = new Select();

$admission = $selectObj->getAdmissionInformationByID($_POST['student-id']);

$accountRegRes = $insertObj->setStudentAccount($_POST['student-id'], $_POST['username'], $_POST['password']);
if($accountRegRes > 0){
    $updateObj->updateEnrollmentAdmissionStatus($admission['AdmissionID'], "finish", "finish");
    unset($_SESSION['STUDENT_ID']);
    $accountRegRes = "success";
}
else{
    $accountRegRes = "error";
}

echo $accountRegRes;