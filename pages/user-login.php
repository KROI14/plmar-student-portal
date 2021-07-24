<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';
?>

<link rel="stylesheet" href="../css/user-login.css?v=<?php echo time()?>">

<section class="container">
    <div class="login-container">
        <p class="sub-header">Login Form</p>

        <label class="title">Username</label>
        <input type="text" class="plmar-input" id="txt-username">

        <label class="title mt-3">Password</label>
        <input type="password" class="plmar-input" id="txt-password">

        <label class="title mt-3">Usertype</label>
        <select class="plmar-input" id="user-type">
            <option value="student">student</option>
            <option value="admin">admin</option>
            <option value="dean">dean</option>
            <option value="faculty">faculty</option>
        </select>

        <div class="d-grid gap-2 mt-3">
        <button class="plmar-btn btn-block mt-4" id="btn-login">Login</button>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-login-result" data-bs-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p class="phar">You entered wrong Username, Password or Usertype</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="plmar-btn" data-bs-dismiss="modal">Okay</button>
        </div>
        </div>
    </div>
</div>

<script src="../js/user-login.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>