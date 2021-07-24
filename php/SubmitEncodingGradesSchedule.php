<?php

include '../includes/classloader.php';

$selectObj = new Select();
$insertObj = new Insert();

$semester = $selectObj->getControl('enrollment-semester');
$schoolYear =  $selectObj->getControl('enrollment-school-year');

$startDate = date('Y-m-d h:i:sa', strtotime($_POST['start-date']));
$endDate = date('Y-m-d h:i:sa', strtotime($_POST['end-date']));

$result = $insertObj->setGradesEncodingSchedule($startDate, $endDate, $schoolYear, $semester);
if($result > 0){
    echo "success";
}
else{
    echo "error";
}