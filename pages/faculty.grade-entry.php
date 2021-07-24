<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $facultyClass = $selectObj->getFacultySchedule($_SESSION['USER_ID'], $_SESSION['SCHOOL_YEAR'], $selectObj->getControl('enrollment-semester'));
?>

<div class="container-fluid">
    <div class="card-container mt-3 grade-input">
        <label class="title">Subject</label>
        <div class="table-container">
            <table class="plmar-table plmar-table-hover">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Course</th>
                        <th>Schedule</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody id="table-subject">
                    <?php for($i = 0; $i < count($facultyClass); $i++): ?>
                        <?php $subjectWithGrade = $selectObj->getCheckIfSubjectHasBeenSubmitted($facultyClass[$i]['SubjectCode'], $_SESSION['USER_ID'], $facultyClass[$i]['Section'], $selectObj->getControl('enrollment-school-year'))?>
                        <?php if($subjectWithGrade <= 0): ?>
                        <tr data-subject-code="<?php echo $facultyClass[$i]['SubjectCode']?>" data-section="<?php echo $facultyClass[$i]['Section']?>" data-course-id="<?php echo $facultyClass[$i]['CourseID']?>">
                            <td><?php echo $facultyClass[$i]['SubjectCode']?></td>
                            <td><?php echo $facultyClass[$i]['Description']?></td>
                            <td><?php echo $facultyClass[$i]['Course']?></td>
                            <td><?php echo $facultyClass[$i]['Day'] . " " . $facultyClass[$i]['Time']?></td>
                            <td><?php echo $facultyClass[$i]['Section']?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="close-message">
        <p class="sub-header">Encoding of grades is currently close</p>
    </div>
</div>


<script>
    $('.grade-input').hide();
    $(function(){
        let subjects = $('#table-subject tr');
        for(let i = 0; i < subjects.length; i++){
            $(subjects[i]).on('click', function(){
                window.location.replace('../pages/faculty.input-grade-entry.php?subcode=' + this.dataset.subjectCode + "&section=" + this.dataset.section + "&cid=" + this.dataset.courseId);
            });
        }
        
        $.ajax({
            url: '../ajax-pages/ajax.encoding-of-grades-schedule.php',
            success:function(e){
                if(e == false){
                    $('.grade-input').hide();
                    $('.close-message').show();
                }
                else{
                    $('.grade-input').show();
                    $('.close-message').hide();
                }
            }
        });
        setInterval(function(){
            $.ajax({
                url: '../ajax-pages/ajax.encoding-of-grades-schedule.php',
                success:function(e){
                    if(e == false){
                        $('.grade-input').hide();
                        $('.close-message').show();
                    }
                    else{
                        $('.grade-input').show();
                        $('.close-message').hide();
                    }
                }
            });
        }, 1000);
    });
</script>

<?php
    include '../includes/footer.inc.php';
?>