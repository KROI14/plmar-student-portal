<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
    
    $course = $selectObj->getCourses();
    $selectedSummer = $selectObj->getControl('enrollment-semester');  
?>

<input type="hidden" id="school-year" value="<?php echo $selectObj->getControl('enrollment-school-year')?>">

<div class="container-fluid py-3">
    <div class="card-container">
        <label class="title">Options</label>
        <div class="row">
            <div class="col-12 col-lg-3">
                <select class="plmar-input" id="select-course">
                    <option value="">Select Course</option>
                    <?php foreach($course as $co): ?>
                        <option value="<?php echo $co['CourseID']?>"><?php echo $co['Course']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="col-12 col-lg-3">
                <select class="plmar-input mt-3 mt-lg-0" id="select-year-level">
                    <option value="">Select Year Level</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>

            <div class="col-12 col-lg-3">
                <select class="plmar-input mt-3 mt-lg-0" id="select-semester">
                    <option value="">Select Semester</option>
                    <option value="1st Semester" <?php echo ($selectedSummer == "1st Semester") ? "selected" : ""?>>1st Semester</option>
                    <option value="2nd Semester" <?php echo ($selectedSummer == "2nd Semester") ? "selected" : ""?>>2nd Semester</option>
                    <option value="Summer" <?php echo ($selectedSummer == "Summer") ? "selected" : ""?>>Summer</option>
                </select>
            </div>

            <div class="col-12 col-lg-3">
                <select class="plmar-input mt-3 mt-lg-0" id="select-section" disabled>
                    <option value="">Select Section</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Schedule</th>
                        <th>Instructor</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody id="table-subject"></tbody>
            </table>
        </div>
    </div>

    <div class="close-message">
        <p class="sub-header">Encoding of grades is currently close</p>
    </div>
</div>

<div class="modal fade" id="modal-grade-list">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
        </div>
    </div>
</div>

<script src="../js/adm.reg.grades-management.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>