<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $course = $selectObj->getCourseByDepartment($user['Department']);
    $selectedSummer = $selectObj->getControl('enrollment-semester');

    $allCourse = $selectObj->getCourses();
?>

<input type="hidden" id="school-year" value="<?php echo $selectObj->getControl('enrollment-school-year')?>">
<input type="hidden" id="department" value="<?php echo $user['Department']?>">
<input type="hidden" id="faculty" value='<?php echo json_encode($selectObj->getFacultyByDepartmentAndRole($user['Department'], "faculty"))?>'>

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
                </select>
            </div>
        </div>
    </div>

    <div class="card-container mt-3">
        <div class="table-container">
            <table class="plmar-table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Schedule</th>
                        <th>Instructor</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody id="table-subjects">
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <?php if($user['Department'] == "PSYCH"): ?>
                <button class="plmar-btn mx-1" data-bs-target="#modal-minor-subjects" data-bs-toggle="modal">Minor Subjects</button>
            <?php endif; ?>
            <button class="plmar-btn mx-1" id="btn-save-major">Save</button>
        </div>
    </div>
</div>


<!-- For Minor SUbjects -->
<div class="modal fade" id="modal-minor-subjects">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Instructor for Minor Subjects</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <select class="plmar-input" id="select-course">
                        <option value="">Select Course</option>
                        <?php foreach($allCourse as $co): ?>
                            <option value="<?php echo $co['CourseID']?>"><?php echo $co['Course']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <select class="plmar-input" id="select-year-level">
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
                    <select class="plmar-input mt-3 mt-lg-0" id="select-section">
                        <option value="">Select Section</option>
                    </select>
                </div>
            </div>

            <div class="table-container mt-3">
                <table class="plmar-table">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Description</th>
                            <th>Schedule</th>
                            <th>Instructor</th>
                            <th>Units</th>
                        </tr>
                    </thead>
                    <tbody id="table-minor-subjects">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
            <button type="button" class="plmar-btn" id="save-minor-subject">Save changes</button>
        </div>
        </div>
    </div>
</div>

<script src="../js/dean.add-instructor.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>