<?php

session_start();
include '../includes/classloader.php';

$insertObj = new Insert();

$result = $insertObj->setAnnouncement($_SESSION['USER_ID'], $_POST['title'], $_POST['content'], $_POST['type']);

echo $result > 0;