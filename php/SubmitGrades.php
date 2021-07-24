<?php

include  '../includes/classloader.php';

$insertObj = new Insert();
$selectObj = new Select();

$studentID = $_POST['student-id'];
$grades = $_POST['grades'];
$schoolYear = $_POST['school-year'];
$subjectCode = $_POST['subject-code'];

for($i = 0; $i < count($grades); $i++){
    $gradeID = $selectObj->getIncrementedID('student_grades', 'GradeID');
    $insertObj->setStudentGrades($gradeID, $studentID[$i], $subjectCode, $grades[$i], $schoolYear, "on process");
}