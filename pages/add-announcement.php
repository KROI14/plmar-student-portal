<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $type = "";
    if($_SESSION['USER_TYPE'] == "admin"){
        $type = "school";
    }
    else if($_SESSION['USER_TYPE'] == "faculty"){
        $type = "class";
    }
    else{
        $type = "department";
    }

    $myAnnouncements = $selectObj->getAnnouncementByAdminID($_SESSION['USER_ID']);
?>

<input type="hidden" id="announce-type" value="<?php echo $type?>">

<div class="container-fluid py-3">
    <div class="card-container">
        <p class="title text-center m-0"><?php echo "Add " . ucfirst($type) . " Announcement"?></p>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card-container mt-3">
                <label class="title">Title</label>
                <input type="text" class="plmar-input" id="txt-title">
            </div>

            <div class="card-container mt-3">
                <label class="title">Content</label>
                <textarea class="plmar-input" id="txt-content" style="resize:none;" rows="12"></textarea>
                <button class="d-block ms-auto plmar-btn" id="btn-post">Post</button>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card-container mt-3">
                <label class="title">My Announcements</label>
                <div class="table-container plmar-table-hover">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody id="table-announcement">
                            <?php foreach($myAnnouncements as $announcement): ?>
                                <tr data-announce-id="<?php echo $announcement['AnnounceID']?>">
                                    <td><?php echo $announcement['AnnounceID']?></td>
                                    <td><?php echo $announcement['Title']?></td>
                                    <td><?php echo date('Y-m-d h:ia', strtotime($announcement['CreatedAt'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<script src="../js/add-announcement.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>