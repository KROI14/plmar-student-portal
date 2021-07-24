<?php

include '../includes/classloader.php';

$selectObj = new Select();

$class = $selectObj->getMinorClassToAddInstructor($_GET['sy'], $_GET['yr'], $_GET['sem'], $_GET['sec'], $_GET['cid']);
echo json_encode($class);
