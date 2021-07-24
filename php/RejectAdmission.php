<?php
    include '../includes/classloader.php';

    $updateObj = new Update();
    
    $updateObj->updateAdmissionStatusByID($_POST['admission-id'], "rejected");

?>