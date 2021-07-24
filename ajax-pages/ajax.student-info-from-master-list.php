<?php
    include '../includes/classloader.php';

    $selectObj = new Select();
    $student = $selectObj->getStudentByID($_POST['student-id']);
    $academicStudent = $selectObj->getStudentAcademicInformationByStudentID($_POST['student-id']);
    $course = $selectObj->getCourseByCourseID($academicStudent['CourseID']);
?>

<div class="text-center">
    <img src="../user-uploads/<?php echo $student['Image'];?>" height="100px" width="100px" class="rounded-circle">
    <p class="text-center title m-0"><?php echo $student['Lastname'] . ", " . $student['Firstname'] . " " . $student['Middlename']?></p>
    <p class="text-center phar m-0"><?php echo $student['StudentID']?></p>
    <p calss="text-center phar m-0"><?php echo $course['Course']?></p>
</div>