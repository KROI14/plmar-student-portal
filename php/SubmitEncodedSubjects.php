<?php

include '../includes/classloader.php';
$insertObj = new Insert();
$updateObj = new Update();
$selectObj = new Select();

$studentID = $_POST['student-id'];
$admissionID = $_POST['admission-id'];

$courseID = $_POST['course-id'];
$yearLevel = $_POST['year-level'];
$semester = $_POST['semester'];
$schoolYear = $_POST['school-year'];

$subjects = $_POST['arr-subject'];
$days = $_POST['arr-days'];
$time = $_POST['arr-time'];
$sections = $_POST['section'];

$type = $_POST['type'];

for($i = 0; $i < count($subjects); $i++){
    $classID = $selectObj->getIncrementedID('student_class', 'ClassID');
    $admin = $selectObj->getAdminFromClass($subjects[$i], $days[$i], $time[$i], $sections[$i], $schoolYear);
    if(is_array($admin)){ $admin = $admin['AdminID']; } else{ $admin = null; }
    $insertObj->setStudentClass($classID, $studentID, $subjects[$i], $days[$i], $time[$i], $sections[$i], $admin, $schoolYear);
}

$academicID = $selectObj->getIncrementedID('student_academic_info', 'AcademicID');
$insertObj->setStudentAcademicInfo($academicID, $studentID, $courseID, $yearLevel, $semester, $schoolYear);

if($type == "old"){
    $updateObj->updateOldStudentEnrollmentStatus($studentID, "payment");
}
else{
    $updateObj->updateEnrollmentAdmissionStatus($admissionID, "payment", "approved");
    $updateObj->updateAdmissionEntry("old", $admissionID);
}