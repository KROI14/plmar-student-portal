<link rel="stylesheet" href="../css/nav.inside-nav.css?v=<?php echo time()?>">
<nav>
    <div class="btn-menu" id="btn-menu">
        <i class="fas fa-bars"></i>
    </div>

    <div class="logo-container">
        <img src="../img/logo_plmar.jpg" width="50px" height="50px" class="rounded-circle">
    </div>

    <div class="account-container" id="btn-account">
        <img src="../user-uploads/<?php echo $user['Image']?>" width="40px" height="40px" class="rounded-circle">
        <label class="phar ms-1"><?php echo $user['Firstname']?></label>
    </div>
</nav>

<aside>
    <ul>
        <?php if($_SESSION['USER_TYPE'] == "admin"): ?>
            <?php if($user['Department'] == "REGISTRAR"): ?>
                <li>
                    <a href="../pages/adm.reg.dashboard.php"
                        class="<?php echo ($currentPage == "adm.reg.dashboard.php") ? "active" : ""?>">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="../pages/adm.reg.admission-list.php"
                        class="<?php echo ($currentPage == "adm.reg.admission-list.php") ? "active" : ""?>">
                        <i class="fas fa-list"></i>List of Admissions
                    </a>
                </li>
                <li>
                    <a href="../pages/adm.reg.grades-management.php"
                        class="<?php echo ($currentPage == "adm.reg.grades-management.php")? "active" : ""?>">
                        <i class="far fa-list-alt"></i>Student Grades
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="../pages/adm.bur.dashboard.php"
                        class="<?php echo ($currentPage == "adm.bur.dashboard.php") ? "active" : ""?>">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="../pages/adm.bur.downpayment-list.php"
                        class="<?php echo ($currentPage == "adm.reg.admission-list.php") ? "active" : ""?>">
                        <i class="fas fa-money-bill-wave-alt"></i>List of Payments
                    </a>
                </li>
            <?php endif; ?>
        <?php elseif($_SESSION['USER_TYPE'] == "dean"): ?>
            <li>
                <a href="../pages/dean.dashboard.php"
                    class="<?php echo ($currentPage == 'dean.dashboard.php') ? "active" : ""?>">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="../pages/dean.encode-subject.php"
                    class="<?php echo ($currentPage == 'dean.encode-subject.php') ? "active" : ""?>">
                    <i class="fas fa-paperclip"></i>Encode Subject
                </a>
            </li>
            <li>
                <a href="../pages/dean.add-instructor.php"
                    class="<?php echo ($currentPage == "dean.add-instructor.php") ? "active" : ""?>">
                    <i class="fas fa-user-plus"></i>Add Instructor
                </a>
            </li>

            <li class="mt-3 ms-1 ms-lg-2" style="color: #9C9C9C; font-size: 14px; font-weight: 600;">
                Curriculum
            </li>
            <?php $courseDept = $selectObj->getCourseByDepartment($user['Department'])?>
            <?php for($i = 0; $i < count($courseDept); $i++): ?>
                <li>
                    <a href="../pages/dean.curriculum.php?cid=<?php echo $courseDept[$i]['CourseID']?>"
                        class="<?php echo ($currentPage == 'dean.curriculum.php?cid=' . $courseDept[$i]['CourseID']) ? "active" : ""?>">
                        <i class="fas fa-apple-alt"></i><?php echo $courseDept[$i]['Abbreviation'];?>
                    </a>
                </li>
            <?php endfor; ?>
        <?php elseif($_SESSION['USER_TYPE'] == "student"):?>
            <li>
                <a href="../pages/stud.dashboard.php"
                    class="<?php echo ($currentPage == "stud.dashboard.php") ? "active" : ""?>">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="../pages/stud.reg-form.php"
                    class="<?php echo ($currentPage == "stud.reg-form.php") ? "active" : ""?>">
                    <i class="fas fa-scroll"></i>Registration Form
                </a>
            </li>
            <li>
                <a href="../pages/stud.assessment-fee.php"
                    class="<?php echo ($currentPage == "stud.assessment-fee.php") ? "active" : ""?>">
                    <i class="fas fa-file-invoice ms-1"></i>Assessment Fees
                </a>
            </li>
            <li>
                <a href="../pages/stud.print-curriculum.php"
                    class="<?php echo ($currentPage == "stud.print-curriculum.php") ? "active" : ""?>">
                    <i class="fas fa-table ms-1"></i>Print Curriculum
                </a>
            </li>
            <li>
                <a href="../pages/stud.check-list.php"
                    class="<?php echo ($currentPage == "stud.check-list.php") ? "active" : ""?>">
                    <i class="fas fa-tasks ms-1"></i>Check List
                </a>
            </li>
            <li>
                <a href="../pages/stud.e-books.php"
                    class="<?php echo ($currentPage == "stud.e-books.php") ? "active" : ""?>">
                    <i class="fas fa-book ms-1"></i>E - Books
                </a>
            </li>
        <?php elseif($_SESSION['USER_TYPE'] == "faculty"):?>
            <li>
                <a href="../pages/faculty.dashboard.php"
                    class="<?php echo ($currentPage == "faculty.dashboard.php") ? "active" : "" ?>">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="../pages/faculty.grade-entry.php"
                    class="<?php echo ($currentPage == "faculty.grade-entry.php") ? "active" : ""?>">
                    <i class="fas fa-clipboard-list"></i>Grade Entry    
                </a>
            </li>

            <li class="mt-3 ms-1 ms-lg-2" style="color: #9C9C9C; font-size: 14px; font-weight: 600;">
                Subject Load
            </li>
            <?php $facultyClass = $selectObj->getFacultySchedule($_SESSION['USER_ID'], $_SESSION['SCHOOL_YEAR'], $selectObj->getControl('enrollment-semester'))?>
            <?php for($i = 0; $i < count($facultyClass); $i++): ?>
                <li>
                    <a href="../pages/faculty.master-list.php?subcode=<?php echo $facultyClass[$i]['SubjectCode']?>&section=<?php echo $facultyClass[$i]['Section']?>&cid=<?php echo $facultyClass[$i]['CourseID']?>"
                        class="<?php echo (urldecode($currentPage) == "faculty.master-list.php?subcode=" . $facultyClass[$i]['SubjectCode'] . "&section=" . $facultyClass[$i]['Section'] . "&cid=" . $facultyClass[$i]['CourseID']) ? "active" : "" ?>">
                        <?php echo $facultyClass[$i]['SubjectCode'] . "(" . $facultyClass[$i]['Section'] . " " . $facultyClass[$i]['Abbreviation'] .")"?>
                    </a>
                </li>
            <?php endfor; ?>
        <?php endif; ?>
    </ul>
</aside>

<div class="profile-container">
    <img src="../user-uploads/<?php echo $user['Image'];?>" width="120px" height="120px" class="rounded-circle mx-auto d-block">
    <?php if(isAdmin($_SESSION['USER_TYPE'])): ?>
        <p class="title mb-0 text-center"><?php echo $user['Firstname'] . " " . $user['Lastname']?></p>
        <p class="phar mb-0 text-center"><?php echo $user['Department'] . "'s " . $user['Role']?></p>
    <?php else: ?>
        <p class="title mb-0 text-center"><?php echo $user['Lastname'] . ", " . $user['Firstname'] . " " . $user['Middlename']?></p>
        <p class="phar mb-0 text-center"><?php echo $user['StudentID'] ?></p>
    <?php endif; ?>

    <div class="d-grid gap-2">
        <a class="plmar-btn" id="btn-logout" href="../php/LogoutUser.php">
            <i class="fas fa-sign-out-alt me-1"></i>Logout
        </a>
    </div>
</div>

<script src='../js/nav.inside-nav.js?v=<?php echo time()?>'></script>