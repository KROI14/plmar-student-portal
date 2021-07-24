<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
?>

<input type="hidden" id="school-year" value="<?php echo $_SESSION['SCHOOL_YEAR'];?>">

<div class="container-fluid pb-3">
    <div class="card-container mt-3">
        <label class="sub-header">On Process</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="table-on-process"></tbody>
            </table>
        </div>
    </div>

    <div class="card-container mt-3">
        <label class="sub-header">Approved Admissions</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="table-approved"></tbody>
            </table>
        </div>
    </div>

    <div class="card-container mt-3">
        <label class="sub-header">Rejected Admissions</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody id="table-rejected"></tbody>
            </table>
        </div>
    </div>
</div>

<script src="../js/adm.reg.admission-list.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>