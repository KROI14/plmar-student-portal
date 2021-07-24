<?php

include '../includes/classloader.php';
$updateObj = new Update();

$gradeID = $_POST['grade-id'];
$status = $_POST['status'];

$strRes = "success";

for($i = 0; $i < count($gradeID); $i++){
    $result = $updateObj->updateGradeStatusByGradeID($gradeID[$i], $status[$i]);
    if(!$result > 0){
        $strRes = "error";
        break;
    }
}

echo $strRes;