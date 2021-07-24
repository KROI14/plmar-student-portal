<?php

include '../includes/classloader.php';

$selectObj = new Select();
$classes = $selectObj->getClassByCourseYearSemSectionSchoolYear($_GET['cid'], $_GET['yr'], $_GET['sem'], $_GET['sec'], $_GET['sy']);
echo json_encode($classes);