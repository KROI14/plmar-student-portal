<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $enrolledSubjects = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
?>

<div class="container-fluid">

    <div class="card-container mt-3">
        <p class="sub-header">E - Books</p>

        <?php for($i = 0; $i < count($enrolledSubjects); $i++): ?>
            <p class="phar mb-0"><?php echo $enrolledSubjects[$i]['SubjectCode'] . " - " . $enrolledSubjects[$i]['Description']?></p>
            <?php $reference = $selectObj->getReferencesBySubjectCode($enrolledSubjects[$i]['SubjectCode']);?>
            <ul>
                <?php for($j = 0; $j < count($reference); $j++): ?>
                    <li><a href="<?php echo $reference[$j]['Link']?>" target="_blank" class="btn btn-link"><?php echo $reference[$j]['Title']?></a></li>
                <?php endfor; ?>
            </ul>
        <?php endfor; ?>
    </div>

</div>

<?php
    include '../includes/footer.inc.php';
?>