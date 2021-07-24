<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
    
    $masterList = $selectObj->getMasterList($_GET['subcode'], $_GET['section'], $_SESSION['SCHOOL_YEAR'], $selectObj->getControl('enrollment-semester'), $_SESSION['USER_ID'], $_GET['cid']);
    $subjectInfo = $selectObj->getSubjectScheduleInformation($_GET['subcode'], $_GET['section'], $_SESSION['USER_ID'], $_SESSION['SCHOOL_YEAR']);
    $gradeDictionary = $selectObj->getGradeDictionary();
?>

<input type="hidden" id="subject-code" value="<?php echo $subjectInfo['SubjectCode']?>">
<input type="hidden" id="user-pass" value="<?php echo $user['Password']?>">
<input type="hidden" id="school-year" value="<?php echo $selectObj->getControl('enrollment-school-year'); ?>">

<div class="container py-3">
    <div class="card-container">
        <label class="sub-header"><?php echo $subjectInfo['SubjectCode'] . " " . $subjectInfo['Description'] . " (" . $subjectInfo['Day'] . " " . $subjectInfo['Time'] . ")"?></label>
        <div class="table-container">
            <table class="plmar-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Year Level</th>
                        <th>Course</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($masterList); $i++): ?>
                        <tr>
                            <td><?php echo $masterList[$i]['StudentID']?></td>
                            <td><?php echo $masterList[$i]['Lastname'] . ", " . $masterList[$i]['Firstname'] . " " . $masterList[$i]['Middlename']?></td>
                            <td><?php echo $masterList[$i]['StudentYearLevel']?></td>
                            <td><?php echo $masterList[$i]['PreferredCourse']?></td>
                            <td>
                                <select data-student-id="<?php echo $masterList[$i]['StudentID']?>" class="plmar-input student-grades">
                                    <?php for($j = 0; $j < count($gradeDictionary); $j++): ?>
                                        <option value="<?php echo $gradeDictionary[$j]['Grade']?>"><?php echo $gradeDictionary[$j]['Grade'] . "/" . $gradeDictionary[$j]['Remarks']?></option>
                                    <?php endfor ?>
                                </select>
                            </td>
                        </tr>
                    <?php endfor?>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <button class="plmar-btn" data-bs-target="#password-confirmation" data-bs-toggle="modal">
                Submit Grades
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="password-confirmation">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="phar">Input your Password</label>
                <input type="password" class="plmar-input text-center" id="password">
            </div>
            <div class="modal-footer">
                <button type="button" class="plmar-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="plmar-btn" id="btn-submit-grades">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#btn-submit-grades').on('click', function(){
            let data = $('.student-grades');

            let studentIDArr = [];
            let gradeArr = [];
            
            for(let i = 0; i < data.length; i++){
                studentIDArr.push(data[i].dataset.studentId);
                gradeArr.push(data[i].value);
            }

            if(gradeArr.includes('no grades')){
                alert("Please Complete the grades of students");
            }
            else{
                if($('#user-pass').val() == $('#password').val()){
                    if(confirm("Are you sure you want to Submit the grades? You cannot edit this anymore")){
                        $.ajax({
                            url: '../php/SubmitGrades.php',
                            type: 'POST',
                            data:{
                                'student-id': studentIDArr,
                                'grades': gradeArr,
                                'school-year': $('#school-year').val(),
                                'subject-code': $('#subject-code').val()
                            },
                            success: function(e){
                                alert("Grades has been successfully Submitted");
                                window.location.replace('../pages/faculty.grade-entry.php');
                            }
                        })
                    }
                }
                else{
                    alert("Incorrect Password");
                }
            }
            
        });

        $('#password-confirmation').on('hide.bs.modal', function(){
            $('#password').val('');
        })
    });
</script>
<?php
    include '../includes/footer.inc.php';
?>