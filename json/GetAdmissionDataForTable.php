<?php

include '../includes/classloader.php';

$selectObj = new Select();

$data = $selectObj->getAdmissionDataForTable($_GET['sy'], $_GET['enroll'], $_GET['adm-status'], $_GET['yr'], $_GET['dept']);
echo json_encode($data);
