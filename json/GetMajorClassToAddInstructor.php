<?php

include '../includes/classloader.php';

$selectObj = new Select();

$res = $selectObj->getMajorClassToAddInstructor($_GET['sy'], $_GET['cid'], $_GET['yr'], $_GET['sem'], $_GET['sec'], $_GET['dept']);
echo json_encode($res);