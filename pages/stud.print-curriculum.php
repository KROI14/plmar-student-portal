<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $academicInfo = $selectObj->getStudentAcademicInformationByStudentID($_SESSION['USER_ID']);
    $subjects = $selectObj->getSubjectCourseByCourse($academicInfo['CourseID']);
    $totalUnits = 0;
    $totalUnitsTaken = 0;
?>

<div class="container-fluid py-3">
    <div class="card-container">
        <div class="overflow-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Subject Unit</th>
                        <th>Taken</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($subjects); $i++): ?>
                        <?php
                            $grade = $selectObj->getSubjectGradeByStudentIDAndSubjectCode($_SESSION['USER_ID'], $subjects[$i]['SubjectCode'], "approved");
                            $taken = "";
                            if(is_array($grade)){
                                $taken = $subjects[$i]['Units'];
                                $totalUnitsTaken += $taken;
                                $grade = $grade['Grade'];
                            }
                            $totalUnits += $subjects[$i]['Units'];
                        ?>
                        <tr>
                            <td><?php echo $subjects[$i]['SubjectCode']?></td>
                            <td><?php echo $subjects[$i]['Description']?></td>
                            <td><?php echo $subjects[$i]['Units']?></td>
                            <td><?php echo $taken?></td>
                            <td><?php echo $grade; ?></td>
                        </tr>
                    <?php endfor;?>
                    <tr>
                        <td colspan="2">Total Units</td>
                        <td><?php echo $totalUnits?></td>
                        <td><?php echo $totalUnitsTaken; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include '../includes/footer.inc.php';
?>