<?php

    include '../includes/classloader.php';

    $selectObj = new Select();
    $sections = $selectObj->getListOfSection($_GET['sy'], $_GET['cid'], $_GET['yr'], $_GET['sem'], $_GET['type']);
    echo json_encode($sections);