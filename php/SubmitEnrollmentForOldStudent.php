<?php
    include '../includes/classloader.php';
    $selectObj = new Select();
    $insertObj = new Insert();

    session_start();

    $result = $selectObj->getStudentByLogin($_POST['username'], $_POST['password']);
    if(is_array($result) && ($result['StudentID'] == $_POST['student-id'])){
        $encodeID = $selectObj->getIncrementedID('old_student_enrollment', 'EncodeID');
        $insertObj->setOldStudentToEncodeSubject($encodeID, $result['StudentID'], "to encode", $selectObj->getControl('enrollment-school-year'));
        $_SESSION['STUDENT_ID'] = $result['StudentID'];
        $_SESSION['TYPE'] = "old";

        echo "success";
    }
    else{
        echo "error";
    }
?>