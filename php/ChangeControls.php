<?php
session_start();
include '../includes/classloader.php';

$updateObj = new Update();

$dbControls = ["enrollment-status", "enrollment-semester", "enrollment-school-year", "subject-encode"];
if(in_array($_POST['control'], $dbControls)){
    $updateRes = $updateObj->updateControls($_POST['control'], $_POST['status']);
    echo "Controls changed successfully";
}
else{
    if($_POST['control'] == "year"){
        $_SESSION['YEAR'] = $_POST['status'];
    }
    else if($_POST['control'] == "semester"){
        $_SESSION['SEMESTER'] = $_POST['status'];
    }
    else{
        $_SESSION['SCHOOL_YEAR'] = $_POST['status'];
    }
    echo "Controls changed successfully";
}