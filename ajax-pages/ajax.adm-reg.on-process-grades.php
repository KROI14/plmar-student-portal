<?php
    include '../includes/classloader.php';
    $selectObj = new Select();

    $subjectGrades = $selectObj->getGradesBySubjectCodeSchoolYearSectionStatusAdmin($_POST['subject-code'], $_POST['school-year'], $_POST['section'], "", $_POST['admin-id']);
    $subjectDesc = $selectObj->getSubjectBySubjectCode($_POST['subject-code']);
?>

<div class="modal-header">
    <h5 class="modal-title">On Process Grades(<?php echo $subjectDesc['Description']?> <?php echo $_POST['subject-code']?>)</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <table class="plmar-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Remarks</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($subjectGrades); $i++): ?>
                <tr>
                    <td><?php echo $subjectGrades[$i]['StudentID']?></td>
                    <td><?php echo $subjectGrades[$i]['Lastname'] . ", " . $subjectGrades[$i]['Firstname'] . " " . $subjectGrades[$i]['Middlename']?></td>
                    <td><?php echo $subjectGrades[$i]['Grade']?></td>
                    <td><?php echo $selectObj->getRemarksByGrade($subjectGrades[$i]['Grade'])['Remarks'];?></td>
                    <td>
                        <select class="plmar-input subject-status" data-grade-id="<?php echo $subjectGrades[$i]['GradeID']?>">
                            <option value="">Select Status</option>
                            <option value="on process" <?php echo ($subjectGrades[$i]['Status'] == "on process") ? "selected" : ""?>>on process</option>
                            <option value="approved" <?php echo ($subjectGrades[$i]['Status'] == "approved") ? "selected" : ""?>>approved</option>
                            <option value="rejected" <?php echo ($subjectGrades[$i]['Status'] == "rejected") ? "selected" : ""?>>rejected</option>
                        </select>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <input type="checkbox" id="check-all"> <label for="check-all">Approve all Students</label>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
    <button type="button" class="plmar-btn" id="btn-update">Update Grades Status</button>
</div>