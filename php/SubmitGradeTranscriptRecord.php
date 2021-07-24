<?php

include '../includes/classloader.php';

$selectObj = new Select();
$insertObj = new Insert();

$studentID = $_POST['student-id'];

//Academic information
$academicID = $selectObj->getIncrementedID('student_academic_info', 'AcademicID');
$courseID = $_POST['course'];
$yearLevel = $_POST['year-level'];
$semester = $_POST['semester'];
$schoolYear = $_POST['school-year'];

$isAcademicInfoOK = false;

$academicInfo = $selectObj->getStudentAcademicInfoByAcademicInfo($studentID, $courseID, $yearLevel, $semester, $schoolYear);
if(!($academicInfo > 0)){
    $academicInfoRes = $insertObj->setStudentAcademicInfo($academicID, $studentID, $courseID, $yearLevel, $semester, $schoolYear);
    if($academicInfoRes > 0){
        $isAcademicInfoOK = true;
    }
}

//Grades & Subject Codes
$arrSubjectCode = $_POST['subject-code'];
$arrGrades = $_POST['grades'];

for($i = 0; $i < count($arrGrades); $i++){
    $isGradesOK = false;

    $studentGrades = $selectObj->getStudentGradesByStudentIDSubjectCodeSchoolYear($studentID, $arrSubjectCode[$i], $schoolYear);
    if(!($studentGrades > 0)){
        $gradesID = $selectObj->getIncrementedID('student_grades', 'GradeID');
        $gradesRes = $insertObj->setStudentGrades($gradesID, $studentID, $arrSubjectCode[$i], $arrGrades[$i], $schoolYear, "approved");
        if($gradesRes > 0){
            $isGradesOK = true;
        }
        else{
            $isGradesOK = false;
            break;
        }
    }
}

echo json_encode(array("academic-info-res" => $isAcademicInfoOK, "grades-result" => $isGradesOK));