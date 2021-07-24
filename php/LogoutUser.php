<?php
    session_start();
    unset($_SESSION['USER_ID']);
    unset($_SESSION['USER_TYPE']);
    unset($_SESSION['SCHOOL_YEAR']);
    unset($_SESSION['YEAR']);
    unset($_SESSION['SEMESTER']);

    header('location: ../pages/user-login.php');