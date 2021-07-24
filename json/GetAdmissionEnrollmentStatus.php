<?php

session_start();
include '../includes/classloader.php';
$selectObj = new Select();

$admission = $selectObj->getAdmissionInformationByID($_SESSION['STUDENT_ID']);
echo json_encode($admission);