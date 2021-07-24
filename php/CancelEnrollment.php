<?php
    session_start();
    unset($_SESSION['STUDENT_ID']);
    unset($_SESSION['TYPE']);
    header('location: ../pages/admission.php?page=list');
?>