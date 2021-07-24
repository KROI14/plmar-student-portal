<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $admission = $selectObj->getAdmissionInformationByID($_GET['stid']);

    $student = $selectObj->getStudentByID($_GET['stid']);
    $address = $selectObj->getAddressByID($_GET['stid']);
    $contactPerson = $selectObj->getContactPersonByID($_GET['stid']);
    $files = $selectObj->getStudentFilesByID($admission['AdmissionID']);
?>

<link rel="stylesheet" href="../css/adm.reg.admission-info.css?v=<?php echo time()?>">

<input type="hidden" id="admission-id" value="<?php echo $admission['AdmissionID']?>">
<input type="hidden" id="student-id" value="<?php echo $_GET['stid']?>">

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card-container mt-3 mb-lg-3">
                <img src="../user-uploads/<?php echo $student['Image']?>" width="100px" height="100px" class="rounded-circle d-block mx-auto">
                <p class="title text-center mb-0"><?php echo $student['Lastname'] . ", " . $student['Middlename'] . " " . $student['Lastname']?></p>
                <p class="text-center phar"><?php echo $student['StudentID']?></p>

                <label class="title">Preferred Course</label>
                <p class="phar ms-4"><?php echo $admission['PreferredCourse']?></p>

                <label class="title">Admission Status</label>
                <p class="phar ms-4"><?php echo $admission['AdmissionStatus'];?></p>

                <label class="title">Admission Status</label>
                <p class="phar ms-4"><?php echo $admission['EnrollStatus'];?></p>

                <label class="title">Admission Entry</label>
                <p class="phar ms-4"><?php echo $admission['Entry']?></p>

                <label class="title">Submitted Date</label>
                <p class="phar ms-4"><?php echo date('F j, Y', strtotime($admission['CreatedAt']))?></p>

                <label class="title">Enrollment Status</label>
                <select class="plmar-input" id="enrollment-status">
                    <option value="none">None</option>
                    <option value="to encode">To Encode</option>
                    <option value="payment">Payment</option>
                    <option value="payment on process">Payment on Process</option>
                    <option value="account registration">Account Registration</option>
                    <option value="finish">Finish</option>
                </select>

                <label class="title mt-4">Residency</label>
                <div class="ms-3">
                    <input type="radio" id="marikina" value="marikina" name="residency" checked> <label for="marikina">Marikina</label>
                    <br>
                    <input type="radio" id="non-marikina" value="non-marikina" name="residency"> <label for="non-marikina">Non Marikina</label>
                </div>

                <button class="plmar-btn d-block mx-auto mt-4" data-bs-toggle="modal" data-bs-target="#grade-transcript-modal">Record Student Transcript</button>
                <button class="plmar-btn d-block mx-auto mt-2" id="btn-update-admission">Update Admission</button>
                <button class="btn btn-danger btn-sm d-block mx-auto mt-2" id="btn-reject-admission">Reject Admission</button>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card-container mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <label class="sub-header">Student Information</label>
                        <table>
                            <tr>
                                <td class="title">Address:</td>
                                <td class="phar"><?php echo $address['HouseNo'] . " " . $address['Street'] . ", " . $address['Barangay'] . ", " . $address['City'] . " " . $address['Province']?></td>
                            </tr>
                            <tr>
                                <td class="title">Gender:</td>
                                <td class="phar"><?php echo $student['Gender']?></td>
                            </tr>
                            <tr>
                                <td class="title">Email:</td>
                                <td class="phar"><?php echo $student['Email']?></td>
                            </tr>
                            <tr>
                                <td class="title">Contact No.:</td>
                                <td class="phar"><?php echo $student['ContactNo']?></td>
                            </tr>
                            <tr>
                                <td class="title">Birthdate:</td>
                                <td class="phar"><?php echo date('F j, Y', strtotime($student['Birthdate']))?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 col-xl-6">
                        <label class="sub-header mt-4 mt-xl-0">Contact Person Information</label>
                        <table>
                            <tr>
                                <td class="title">Name:</td>
                                <td class="phar"><?php echo $contactPerson['Firstname'] . " " . $contactPerson['Lastname']?></td>
                            </tr>
                            <tr>
                                <td class="title">Email:</td>
                                <td class="phar"><?php echo $contactPerson['Email']?></td>
                            </tr>
                            <tr>
                                <td class="title">Contact No:</td>
                                <td class="phar"><?php echo $contactPerson['ContactNo']?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 col-xl-6">
                        <label class="sub-header mt-4">File Documents</label>
                        <?php for($i = 0; $i < count($files); $i++): ?>
                            <a class="plmar-btn" href="../user-uploads/<?php echo $files[$i]['File'];?>" download="<?php echo $files[$i]['Filename']?>">
                                <i class="fas fa-file-download me-2"></i><?php echo $files[$i]['Filename']?>
                            </a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Insertion of subject -->
<div class="modal fade" id="grade-transcript-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Academic Transcript</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <?php $course = $selectObj->getCourses();?>
                        <select class="plmar-input mt-2" id="select-course">
                            <option value="">Select Course</option>
                            <?php for($i = 0; $i < count($course); $i++): ?>
                                <option value="<?php echo $course[$i]['CourseID']; ?>"><?php echo $course[$i]['Course']; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <select class="plmar-input mt-2" id="select-year">
                            <option value="">Select Year Level</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <select class="plmar-input mt-2" id="select-semester">
                            <option value="">Select Semester</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <select class="plmar-input mt-2" id="select-school-year">
                            <option value="">Select School Year</option>
                            <?php for($i = 2010; $i < 2030; $i++): ?>
                                <option value="<?php echo $i . " - " . ($i + 1);?>"><?php echo $i . " - " . ($i + 1);?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="plmar-btn w-100 mt-2" id="btn-enter">Enter</button>
                    </div>
                </div>

                <div class="table-container mt-3">
                    <table class="plmar-table">
                        <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th>Units</th>
                                <th>Grades</th>
                            </tr>
                        </thead>
                        <tbody id="subject-table">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="plmar-btn" id="btn-submit-grades">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/adm.reg.admission-info.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>