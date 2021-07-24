<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
?>

<style>
    .reg-form-container{
        overflow: auto;
    }
</style>

<div class="container-fluid py-3">
    <div class="card-container">
        <div class="reg-form-container">
        </div>
    </div>
</div>

<script>
    $(function(){
        $('.reg-form-container').load('../ajax-pages/ajax.registration-form.php',{
            'student-id': "<?php echo $_SESSION['USER_ID']?>"
        });
    })
</script>
<?php
    include '../includes/footer.inc.php'
?>