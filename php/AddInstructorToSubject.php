<?php

include '../includes/classloader.php';

$updateObj = new Update();

for($i = 0; $i < count($_POST['subjects']); $i++){
    $admin = ($_POST['admin'][$i] === "null") ? NULL : $_POST['admin'][$i];
    $result = $updateObj->updateClassToAddInstructor($admin, $_POST['subjects'][$i], $_POST['section'], $_POST['school-year']);
}