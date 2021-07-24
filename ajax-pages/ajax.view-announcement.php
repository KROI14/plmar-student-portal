<?php
    session_start();
    include '../includes/classloader.php';
    $selectObj = new Select();
    
    $announcement = $selectObj->getAnnouncementByID($_POST['announce-id']);
?>

<div class="modal-header">
    <h5 class="modal-title">Announcement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <h6 class="title"><?php echo $announcement['Title']?></h6>
    <p style="text-indent: 50px;"><?php echo $announcement['Content']?></p>
    
    <figcaption class="blockquote-footer text-end">
        Posted by<cite title="Source Title"> <?php echo $announcement['Firstname'] . " " . $announcement['Lastname'] . " " . $announcement['Department'] . "'s " . $announcement['Role']?></cite>
    </figcaption>    
    
    <figcaption class="blockquote-footer text-end">
        Posted on<cite title="Source Title"> <?php echo date('M d, Y h:ia', strtotime($announcement['CreatedAt']))?></cite>
    </figcaption>
</div>

<div class="modal-footer">
    <?php if(isset($_SESSION['USER_TYPE']) && isset($_POST['from'])): ?>
        <button class="btn btn-danger" id="btn-delete">Delete</button>
    <?php endif; ?>
    <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
</div>