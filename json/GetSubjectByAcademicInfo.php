<?php

include '../includes/classloader.php';

$selectObj = new Select();

$subjects = $selectObj->getSubjectByAcademicInfo($_GET['cid'], $_GET['yr'], $_GET['sem']);

echo json_encode($subjects);