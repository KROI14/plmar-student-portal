<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $facultyClass = $selectObj->getFacultySchedule($_SESSION['USER_ID'], $_SESSION['SCHOOL_YEAR'], $selectObj->getControl('enrollment-semester'));
?>
<link rel="stylesheet" href="../css/faculty.dashboard.css?v=<?php echo time()?>">

<input type="hidden" id="user-pass" value="<?php echo $user['Password']?>">

<div class="container-fluid pb-3">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="status-container mx-auto mt-3 control">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="phar m-0">School Year</p>
                    <i class="fas fa-pen" data-control="school-year"></i>
                </div>
                <p class="sub-header text-center"><?php echo $_SESSION['SCHOOL_YEAR']; ?></p>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="status-container mx-auto mt-3 control">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="phar m-0">Year</p>
                    <i class="fas fa-pen" data-control="year"></i>
                </div>
                <p class="sub-header text-center"><?php echo $_SESSION['YEAR']; ?></p>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <?php
                $gradesEncodingSchedule = $selectObj->getEncodingOfGradesSchedule($selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
                if(is_array($gradesEncodingSchedule)){
                    $startDate = $gradesEncodingSchedule['StartingDateTime'];
                    $endDate = $gradesEncodingSchedule['EndingDateTime'];
                }
                else{
                    $startDate = "";
                    $endDate = "";
                }
            ?>
            <div class="status-container mt-3 mx-auto">
                <div class="d-flex justify-content-between align-itmes-center">
                    <p class="phar m-0">Encoding of Grades Schedule</p>
                    <i class="fas fa-pen" data-control="subject-encode"></i>
                </div>
                <table>
                    <tr>
                        <td class="pe-3">Starting Date:</td>
                        <td class="title"><?php echo $startDate?></td>
                    </tr>
                    <tr>
                        <td>Ending Date:</td>
                        <td class="title"><?php echo $endDate?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <label class="title">Subject Load Schedule</label>
        <div class="table-container">
            <table class="plmar-table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Course</th>
                        <th>Schedule</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($facultyClass); $i++): ?>
                        <tr>
                            <td><?php echo $facultyClass[$i]['SubjectCode']?></td>
                            <td><?php echo $facultyClass[$i]['Description']?></td>
                            <td><?php echo $facultyClass[$i]['Abbreviation']?></td>
                            <td><?php echo $facultyClass[$i]['Day'] . " " . $facultyClass[$i]['Time']?></td>
                            <td><?php echo $facultyClass[$i]['Section']?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <div class="row mt-3">
        <div class="col-12 col-lg-7"> -->
            <div class="card-container mt-3 announcement">
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

            <div class="card-container mt-3 announcement">
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
        <!-- </div>
    </div> -->
</div>

<div class="modal fade" id="modal-change-status">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="plmar-btn" id="btn-save">Save changes</button>
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

<script src="../js/faculty.dashboard.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>