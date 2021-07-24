<?php

    include '../includes/classloader.php';
    $deleteObj = new Delete();

    $res = $deleteObj->dropAnnouncementByID($_POST['announce-id']);
    if($res > 0){
        echo "success";
    }
    else{
        echo "error";
    }

?>