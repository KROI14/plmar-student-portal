<?php

include '../includes/classloader.php';

$selectObj = new Select();
$downpayments = $selectObj->getDownpaymentApprovalDataForTable($_GET['st'], $_GET['sy'], $_GET['sem']);
echo json_encode($downpayments);