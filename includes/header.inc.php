<?php
    session_start();
    include '../includes/classloader.php';
    $currentPage = basename($_SERVER['REQUEST_URI']);

    function isAdmin($userType){
        return $userType == "admin" || $userType == "faculty" || $userType == "dean";
    }

    $selectObj = new Select();

    if(isset($_SESSION['USER_ID'])){
        if(isAdmin($_SESSION['USER_TYPE'])){
            $user = $selectObj->getAdminByID($_SESSION['USER_ID']);
        }
        else{
            $user = $selectObj->getStudentByID($_SESSION['USER_ID']);
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/style-resources.css?v=<?php echo time()?>">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500;600;700&display=swap" rel="stylesheet">
        
        <title>Pamantasan ng Lungsod ng Marikina</title>
    </head>
    <body>