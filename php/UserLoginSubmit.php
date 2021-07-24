<?php

function isAdmin($userType){
    return $userType == "admin" || $userType == "faculty" || $userType == "dean";
}

session_start();
include '../includes/classloader.php';

$selectObj = new Select();

$result = array();

if(isAdmin($_POST['usertype'])){
    $admin = $selectObj->getAdminLogin($_POST['username'], $_POST['password'], $_POST['usertype']);
    if(count($admin) > 0){
        $_SESSION['USER_ID'] = $admin['AdminID'];
        $_SESSION['USER_TYPE'] = $_POST['usertype'];
        $_SESSION['SCHOOL_YEAR'] = $selectObj->getControl('enrollment-school-year');
        $_SESSION['YEAR'] = date('Y');
        $_SESSION['SEMESTER'] = $selectObj->getControl('enrollment-semester');
        $result['res'] = true;
        $result['dept'] = $admin['Department'];
    }
    else{
        $result['res'] = false;
    }
}
else{
    $student = $selectObj->getStudentByLogin($_POST['username'], $_POST['password']);
    if(count($student) > 0){
        $result['res'] = true;
        $_SESSION['USER_ID'] = $student['StudentID'];
        $_SESSION['USER_TYPE'] = $_POST['usertype'];
    }
    else{
        $result['res'] = false;
    }
}

echo json_encode($result);