<?php

include '../includes/classloader.php';

$insertObj = new Insert();
$selectObj = new Select();
$deleteObj = new Delete();

$schoolYear = $selectObj->getControl("enrollment-school-year");

$results = array();

$studentID = $selectObj->getIncrementedID("student", "StudentID");
$studentRes = $insertObj->setStudent($studentID, $_POST['txt-fName'], $_POST['txt-mName'],
                $_POST['txt-lName'], $_POST['rb-gender'], $_POST['txt-email'], 
                $_POST['txt-contact'], $_POST['txt-birthdate'], $_FILES['input-img-file']);
array_push($results, $studentRes);


$addressRes = $insertObj->setAddress($studentID, $_POST['txt-house-no'], $_POST['txt-street'],
                $_POST['txt-brgy'], $_POST['txt-city'], $_POST['txt-province']);
array_push($results, $addressRes);


$contactPersonRes = $insertObj->setContactPerson($studentID, $_POST['txt-con-fName'],
                $_POST['txt-con-lName'], $_POST['txt-con-email'], $_POST['txt-con-contact']);
array_push($results, $contactPersonRes);


$admissionID = $selectObj->getIncrementedID("admission_info", "AdmissionID");
$controlNo = rand(pow(10, 7-1), pow(10, 7) - 1);
$admissionInfoRes = $insertObj->setAdmissionInfo($admissionID, $studentID, $_POST['select-entry'],
                $_POST['select-course'], $controlNo, $schoolYear);
array_push($results, $admissionInfoRes);

$fileCount = 4;
if($_POST['select-entry'] == "Transferee"){
    $fileCount = 5;
}
for($i = 0; $i < $fileCount; $i++){
    $fileID = $selectObj->getIncrementedID("student_files", "FileID");
    $fileRes = $insertObj->setStudentFiles($fileID, $admissionID, $_FILES['input-files']['name'][$i], $_FILES['input-files']['tmp_name'][$i]);
    array_push($results, $fileRes);
}

$res = false;
for($i = 0; $i < count($results); $i++){
    if($results[$i] > 0){ $res = true; } else{ $res = false; break; }
}

if($res == false){
    $deleteObj->dropStudentByID($studentID);
}

echo json_encode(array(
    "result" => $res,
    "admissionID" => $admissionID
));