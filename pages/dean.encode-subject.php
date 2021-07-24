<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
?>

<input type="hidden" id="department" value="<?php echo $user['Department']?>">
<input type="hidden" id="school-year" value="<?php echo $selectObj->getControl('enrollment-school-year')?>">

<div class="container-fluid">
    <div class="card-container mt-3">
        <label class="sub-header">List of "to encode" students from Admission</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody id="to-encode-from-admission-table"></tbody>
            </table>
        </div>
    </div>

    <div class="card-container mt-3">
        <label class="sub-header">List of "to encode" old students</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                    </tr>
                </thead>
                <tbody id="to-encode-old-students"></tbody>
            </table>
        </div>
    </div>
</div>

<script src="../js/dean.encode-subject.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>