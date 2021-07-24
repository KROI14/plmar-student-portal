<?php

    include '../includes/classloader.php';
    $selectObj = new Select();

    $data = $selectObj->getToEncodeOldStudents($selectObj->getControl('enrollment-school-year'), $_GET['type']);
    echo json_encode($data);
?>