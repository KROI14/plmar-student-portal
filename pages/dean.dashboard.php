<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
?>

<link rel="stylesheet" href="../css/dean.dashboard.css?v=<?php echo time()?>">

<input type="hidden" id="user-password" value="<?php echo $user['Password']?>">

<div class="container-fluid pb-3">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="status-container ms-lg-auto me-lg-0 mx-auto mt-3 control">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="phar m-0">School Year</p>
                    <i class="fas fa-pen" data-control="school-year"></i>
                </div>
                <p class="sub-header text-center"><?php echo $_SESSION['SCHOOL_YEAR']; ?></p>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="status-container me-lg-auto ms-lg-0 mx-auto mt-3 control">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="phar m-0">Year</p>
                    <i class="fas fa-pen" data-control="year"></i>
                </div>
                <p class="sub-header text-center"><?php echo $_SESSION['YEAR']; ?></p>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-lg-7">
            <div class="card-container">
                <label class="title">School Announcements</label>
                <?php $announcement = $selectObj->getAnnouncementByType('school', ""); ?>
                <div class="list-group mt-2 school-announce">
                    <?php foreach($announcement as $num => $announce): ?>
                        <a href="#" class="list-group-item list-group-item-action" data-announce-id="<?php echo $announce['AnnounceID']?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo $announcement[$num]['Title']?></h5>
                                <small><?php echo date('F d, Y h:ia', strtotime($announcement[$num]['CreatedAt']))?></small>
                            </div>
                            <p class="mb-1"><?php echo $announcement[$num]['Content']?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card-container mt-3">
                <label class="title">Department Announcements</label>
                <?php $announcement = $selectObj->getAnnouncementByType('department', $user['Department']); ?>
                <div class="list-group mt-2 school-announce">
                    <?php foreach($announcement as $num => $announce): ?>
                        <a href="#" class="list-group-item list-group-item-action" data-announce-id="<?php echo $announce['AnnounceID']?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo $announcement[$num]['Title']?></h5>
                                <small><?php echo date('F d, Y h:ia', strtotime($announcement[$num]['CreatedAt']))?></small>
                            </div>
                            <p class="mb-1"><?php echo $announcement[$num]['Content']?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card-container mt-3 mt-lg-0">
                <div class="text-center">
                    <button class="plmar-btn w-100" id="btn-add-announcement">Add Announcement</button>
                </div>

                <?php $announcement = $selectObj->getAnnouncementByAdminID($_SESSION['USER_ID']);?>
                <p class="title mt-3 mb-0">My Announcements</p>
                <div class="table-container" style="height: 300px;">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < count($announcement); $i++): ?>
                                <tr>
                                    <td><?php echo $announcement[$i]['AnnounceID']; ?></td>
                                    <td><?php echo $announcement[$i]['Title']; ?></td>
                                    <td><?php echo date('F d, Y h:ia', strtotime($announcement[$i]['CreatedAt'])); ?></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-change-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="plmar-btn" id="change-status">Save changes</button>
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

<script src="../js/dean.dashboard.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>