<link rel="stylesheet" href="../css/nav.outside-nav.css?v=<?php echo time()?>">

<nav>
    <div class="logo-container">
        <img src="../img/logo_plmar.jpg" width="55px" height="55px" class="rounded-circle">
    </div>
    <div class="btn-menu" id="btn-nav-menu">
        <i class="fas fa-bars"></i>
    </div>

    <ul>
        <li>
            <a href="../pages/index.php"
                class="<?php echo ($currentPage == "index.php") ? "active" : ""?>">Home</a>
        </li>

        <?php if(isset($_SESSION['STUDENT_ID'])): ?>
            <?php $admission = $selectObj->getAdmissionInformationByID($_SESSION['STUDENT_ID']); ?>
            <?php
                $oldEnroll = $selectObj->getOldStudentEnrollmentByStudentIDSChoolYear($_SESSION['STUDENT_ID'], $selectObj->getControl('enrollment-school-year'));
                if(is_array($oldEnroll)){
                    $oldEnroll = $selectObj->getOldStudentEnrollmentByStudentIDSChoolYear($_SESSION['STUDENT_ID'], $selectObj->getControl('enrollment-school-year'));
                }
                else{
                    $oldEnroll['EnrollmentStatus'] = "none";
                }
            ?>
            <?php if($admission['EnrollStatus'] == "payment" || $oldEnroll['EnrollmentStatus'] == "payment" || $oldEnroll['EnrollmentStatus'] == "to encode"): ?>
                <li>
                    <a href="../pages/enrollment.encoded-subject.php"
                        class="<?php echo ($currentPage == "enrollment.encoded-subject.php") ? "active": ""?>">
                        Encoded Subjects
                    </a>
                </li>
            <?php elseif($admission['EnrollStatus'] == "payment on process" || $admission['EnrollStatus'] == "account registration" || $oldEnroll['EnrollmentStatus'] == "finish"): ?>
                <li>
                    <a href="../pages/enrollment.reg-form.php"
                        class="<?php echo ($currentPage == "enrollment.reg-form.php") ? "active": ""?>">
                        Registration Form
                    </a>
                </li>
            <?php endif;?>
        <?php else: ?>
            <li>
                <a href="../pages/admission.php?page=list"
                    class="<?php echo ($currentPage == "admission.php?page=list" || $currentPage == "admission.php?page=form" || $currentPage == "admission.php?page=old-enrollment") ? "active" : ""?>">Admission</a>
            </li>
        <?php endif; ?>

        <li>
            <a href="../pages/user-login.php"
                class="<?php echo ($currentPage == "user-login.php") ? "active" : ""?>">Login</a>
        </li>
    </ul>
</nav>

<script src="../js/nav.outside-nav.js?v=<?php echo time()?>"></script>