<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $subjectInfo = $selectObj->getSubjectScheduleInformation($_GET['subcode'], $_GET['section'], $_SESSION['USER_ID'], $_SESSION['SCHOOL_YEAR']);
    $masterList = $selectObj->getMasterList($_GET['subcode'], $_GET['section'], $_SESSION['SCHOOL_YEAR'], $selectObj->getControl('enrollment-semester'), $_SESSION['USER_ID'], $_GET['cid']);
?>

<div class="container-fluid py-3">
    <div class="card-container">
        <label class="sub-header">
            <?php echo $subjectInfo['SubjectCode'] . " " . $subjectInfo['Description'] . " (" . $subjectInfo['Day'] . " " . $subjectInfo['Time'] . ")"?>
        </label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Year Level</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody id="table-students">
                    <?php for($i = 0; $i < count($masterList); $i++): ?>
                        <tr data-student-id="<?php echo $masterList[$i]['StudentID']?>">
                            <td><?php echo $masterList[$i]['StudentID']?></td>
                            <td><?php echo $masterList[$i]['Lastname'] . ", " . $masterList[$i]['Firstname'] . " " . $masterList[$i]['Middlename']?></td>
                            <td><?php echo $masterList[$i]['StudentYearLevel']?></td>
                            <td><?php echo $masterList[$i]['PreferredCourse']?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-student-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/faculty.master-list.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>