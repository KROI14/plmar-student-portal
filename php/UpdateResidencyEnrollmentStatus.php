<?php

include '../includes/classloader.php';

$updateObj = new Update();

$updateObj->updateEnrollmentStatus($_POST['enroll-status'], $_POST['admission-id']);
$updateObj->updateResidency($_POST['student-id'], $_POST['residency']);

echo "success";