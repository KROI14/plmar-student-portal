<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';
    
    $student = $selectObj->getStudentByID($_SESSION['STUDENT_ID']);
?>

<input type="hidden" id="student-id" value="<?php echo $_SESSION['STUDENT_ID']?>">

<link rel="stylesheet" href="../css/enrollment.reg-form.css?v=<?php echo time()?>">

<div class="container py-3">
    <div class="reg-form-container">
    </div>
    
    <?php if(isset($_SESSION['TYPE'])): ?>
        <?php
            $oldEnrollStatus = $selectObj->getOldStudentEnrollmentByStudentIDSChoolYear($_SESSION['STUDENT_ID'], $selectObj->getControl('enrollment-school-year'));
            if($oldEnroll['EnrollmentStatus'] == "finish"):
        ?>
            <div class="text-center mt-3">
                <button class="plmar-btn" id="btn-finish">Finish</button>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="text-center mt-3" id="btn-container">
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="modal-account-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="../user-uploads/<?php echo $student['Image']?>" width="100px" height="100px" class="rounded-circle mx-auto d-block">
                <p class="phar mb-0 text-center mt-1"><?php echo $_SESSION['STUDENT_ID']?></p>

                <div class="register-inputs">
                    <label class="phar mt-4">Username</label>
                    <input type="text" class="plmar-input text-center" id="txt-username" value="<?php echo strtolower($student['Lastname']) . ".stud@plmar"?>" readonly>

                    <label class="phar mt-3">Password</label>
                    <input type="password" class="plmar-input text-center" id="txt-pass">

                    <label class="phar mt-3">Password Confirmation</label>
                    <input type="password" class="plmar-input text-center" id="txt-pass-confirm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="plmar-btn" id="btn-register">Register</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/enrollment.reg-form.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>