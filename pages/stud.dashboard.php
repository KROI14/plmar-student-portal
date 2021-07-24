<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $enrolledSubjects = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
    $academicInfo = $selectObj->getStudentAcademicInformationByStudentID($_SESSION['USER_ID']);
    $course = $selectObj->getCourseByCourseID($academicInfo['CourseID']);
?>

<link rel="stylesheet" href="../css/stud.dashboard.css?v=<?php echo time()?>">

<div class="container-fluid py-3">
    <div class="card-container">
        <label class="title">Enrolled Subjects</label>
        <table class="plmar-table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Units</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < count($enrolledSubjects); $i++): ?>

                    <tr>
                        <td><?php echo $enrolledSubjects[$i]['SubjectCode']?></td>
                        <td><?php echo $enrolledSubjects[$i]['Description']?></td>
                        <td><?php echo $enrolledSubjects[$i]['Day'] . " " . $enrolledSubjects[$i]['Time']?></td>
                        <td><?php echo $enrolledSubjects[$i]['Units']?></td>

                        <?php $instructor = $selectObj->getAdminByID($enrolledSubjects[$i]['AdminID']);?>
                        <td><?php echo (is_array($instructor)) ? $instructor['Firstname'] . " " . $instructor['Lastname'] : "n/a"?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>


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
        <?php $announcement = $selectObj->getAnnouncementByType('department', $course['Department']); ?>
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


<div class="modal fade" id="modal-announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    $(function(){
        let schoolAnnounce = $('.school-announce a');
        for(let i = 0; i < schoolAnnounce.length; i++){
            $(schoolAnnounce[i]).on('click', function(){
                $('#modal-announcement').modal('show');
                $('#modal-announcement .modal-content').load('../ajax-pages/ajax.view-announcement.php', {
                    'announce-id': $(schoolAnnounce[i]).data('announceId')
                })
            })
        }
    })
</script>
<?php
    include '../includes/footer.inc.php';
?>