<?php
    include '../includes/classloader.php';
    date_default_timezone_set('Asia/Manila');

    $selectObj = new Select();

    $schedule = $selectObj->getEncodingOfGradesSchedule($selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
    if(is_array($schedule)){
        $startDate = $schedule['StartingDateTime'];
        $endDate = $schedule['EndingDateTime'];
        $now = date('Y-m-d h:i:sa');
    }
    else{
        $startDate = "";
        $endDate = "";
        $now = "";
    }

    echo strtotime($startDate) < strtotime($now) && strtotime($now) < strtotime($endDate);
?>