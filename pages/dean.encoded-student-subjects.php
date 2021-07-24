<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    function arrayPrinter($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function addSection($lastSection){
        $num = preg_replace('/[^0-9]/', '', $lastSection);
        return "Section " . ++$num;
    }

    //Selects Existing days
    function selectDay($subjectSection, $day){
        if(is_array($subjectSection)){
            if($subjectSection['Day'] == $day){
                return "selected";
            }
        }
        else{
            return "";
        }
    }

    //Selects Existing Time
    function selectTime($subjectSection, $time){
        if(is_array($subjectSection)){
            if($subjectSection['Time'] == $time){
                return "selected";
            }
        }
        else{
            return "";
        }
    }

    function sortOutCreditedSubjects($gradesArr, $subjectArr){
        foreach($subjectArr as $subKey => $subVal){
            foreach($gradesArr as $gradeKey => $gradeVal){
                if($gradeVal['Grade'] !== "5.00"){
                    if($subVal['SubjectCode'] == $gradeVal['SubjectCode']){
                        unset($subjectArr[$subKey]);
                    }
                }
            }
        }
        return $subjectArr;
    }
    
    $selectObj = new Select();

    $tuitionFee = 0;
    $miscFee = 0;

    $student = $selectObj->getStudentByID($_GET['stid']);
    $address = $selectObj->getAddressByID($_GET['stid']);
    $admission = $selectObj->getAdmissionInformationByID($_GET['stid']);

    $course = $selectObj->getCourseByCourse($admission['PreferredCourse']);
    $semester = $selectObj->getControl("enrollment-semester"); //Control
    $schoolYear = $selectObj->getControl("enrollment-school-year"); //Control
    
    //Collecting subject for New Student Entry
    if($admission['Entry'] == "New Student"){
        $courseID = $course['CourseID'];
        $yearLevel = "1st Year";
        $officialSubjects = $selectObj->getSubjectByAcademicInfo($courseID, $yearLevel, $semester);
    }
    else{//Collecting Subject for Old Student
        $courseID = $course['CourseID'];

        $academicObj = $selectObj->getStudentAcademicInformationByStudentID($_GET['stid']);

        if($semester == "1st Semester"){
            switch($academicObj['YearLevel']){
                case "1st Year": $yearLevel = "2nd Year";
                break;

                case "2nd Year": $yearLevel = "3rd Year";
                break;

                case "3rd Year": $yearLevel = "4th Year";
                break;

                default: $yearLevel = "4th Year";
            }
        }
        else{
            $yearLevel = $academicObj['YearLevel'];
        }
        
        switch($academicObj['YearLevel']){
            case "1st Year": $prevYearLevel = "1st Year";;
            break;

            case "2nd Year": $prevYearLevel = "1st Year";
            break;

            case "3rd Year": $prevYearLevel = "2nd Year";
            break;

            case "4th Year": $prevYearLevel = "3rd Year";
            break;
        }

        //Fixing credited subjects
        $lastYearLevelGrades = $selectObj->getLastYearLevelGrades($_GET['stid'], $prevYearLevel, $semester, $academicObj['CourseID']); //Get Last year grades EX: Current(2nd Year, 1st Sem) Last(1st Year)
        $lastYearSubjects = $selectObj->getSubjectByAcademicInfo($courseID, $prevYearLevel, $semester); //Getting Last subejcts Ex: ^^^^^^^^^^^^^^^^

        $lastYearSubjects = sortOutCreditedSubjects($lastYearLevelGrades, $lastYearSubjects);//Collecting uncredited subjects
        $currentSubject = $selectObj->getSubjectByAcademicInfo($courseID, $yearLevel, $semester);//Collecting current subjects

        foreach($currentSubject as $key => $current){
            foreach($lastYearSubjects as $lastYear){
                if($current['SubjectCode'] == $lastYear['SubjectCode']){
                    unset($currentSubject[$key]);
                }
            }
        }

        $officialSubjects = array_merge($currentSubject, $lastYearSubjects);//Merge the credited and uncredited
    }
    
    $misc = $selectObj->getMiscellaneousByAcademicInfo($courseID, $yearLevel, $semester);
?>

<input type="hidden" id="student-id" value="<?php echo $_GET['stid']?>">
<input type="hidden" id="admission-id" value="<?php echo $admission['AdmissionID']?>">
<input type="hidden" id="course-id" value="<?php echo $courseID?>">
<input type="hidden" id="year-level" value="<?php echo $yearLevel?>">
<input type="hidden" id="semester" value="<?php echo $semester?>">
<input type="hidden" id="school-year" value="<?php echo $schoolYear?>">
<input type="hidden" id="student-type" value="<?php echo (isset($_GET['type'])) ? $_GET['type'] : "new" ?>">

<link rel="stylesheet" href="../css/dean.encoded-student-subjects.css?v=<?php echo time()?>">

<div class="container-fluid">
    <div class="card-container mt-3">
        <div class="subject-enlist">
            <div class="enlisted-subject border p-3">
                <p class="sub-header text-center m-0">Pamantasan ng Lungsod ng Marikina</p>
                <p class="phar text-center m-0">Brazil St., Greenheights Subdivision, Marikina, 1800 Metro Manila</p>
                <p class="title text-center m-0">Registration and Assessment Form</p>
                <p class="title m-0 text-center">SY <?php echo $schoolYear?></p>

                <!-- Informations -->
                <div class="row mt-4 mx-2">
                    <div class="col-6">
                        <table>
                            <tr>
                                <td class="phar">Student ID:</td>
                                <td class="title"><?php echo $student['StudentID']?></td>
                            </tr>
                            <tr>
                                <td class="phar">Name:</td>
                                <td class="title"><?php echo $student['Lastname'] . ", " . $student['Firstname'] . " " . $student['Middlename']?></td>
                            </tr>
                            <tr>
                                <td class="phar">Gender:</td>
                                <td class="title"><?php echo $student['Gender']?></td>
                            </tr>
                            <tr>
                                <td class="phar">Residency:</td>
                                <td class="title"><?php echo $address['City']?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-6">
                        <table>
                            <tr>
                                <td class="phar">Course:</td>
                                <td class="title"><?php echo $course['Course']?></td>
                            </tr>
                            <tr>
                                <td class="phar">Year Level:</td>
                                <td class="title"><?php echo $yearLevel?></td>
                            </tr>
                            <tr>
                                <td class="phar">Semester:</td>
                                <td class="title"><?php echo $semester?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Subjects -->
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Total Units</th>
                            <th>Subject Fee</th>
                        </tr>
                    </thead>
                    <tbody id="subjects">
                        <?php foreach($officialSubjects as $subject): //Loop through collected subjects?>
                            <?php
                                //Subject and section Description
                                $subjectSection = $selectObj->getSectionOfSubjectBySubjectIDAndSchoolYear($subject['SubjectID'], $schoolYear);
                                
                                $defaultSection = "Section 1";

                                //if Section exists on a certain subject
                                if(is_array($subjectSection)){
                                    $numOfStudent = $selectObj->getNumberOfStudentsInSectionSubject($subject['SubjectID'], $subjectSection['Section'], $schoolYear); //No. of student Obj Returns Count of student in a certain subject and section
                                    $defaultSection = $subjectSection['Section']; //Returns section from the certains subject
                                    $numOfStudent = $numOfStudent['COUNT(*)']; // Returns no. of students

                                    //if no. of students is larger than 30 add section
                                    if($numOfStudent >= 30){
                                        $defaultSection = addSection($defaultSection);
                                    }
                                }
                                else{
                                    $numOfStudent = 0;
                                }
                            ?>

                            <tr data-subject-id="<?php echo $subject['SubjectID']?>" data-section="<?php echo $defaultSection?>">
                                <td><?php echo $subject['SubjectCode']?></td>
                                <td><?php echo $subject['Description']?></td>
                                <td>
                                    <select class="plmar-input select-days">
                                        <option value="" <?php echo ($numOfStudent >= 30) ? "selected" : ""?>>Select Days Schedule</option>
                                        <option value="MON" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "MON") : ""?>>MON</option>
                                        <option value="TUE" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "TUE") : ""?>>TUE</option>
                                        <option value="WED" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "WED") : ""?>>WED</option>
                                        <option value="THU" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "THU") : ""?>>THU</option>
                                        <option value="FRI" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "FRI") : ""?>>FRI</option>
                                        <option value="SAT" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "SAT") : ""?>>SAT</option>
                                        <option value="SUN" <?php echo ($numOfStudent < 30) ? selectDay($subjectSection, "SUN") : ""?>>SUN</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="plmar-input select-time">
                                        <option value="" <?php echo ($numOfStudent >= 30) ? "selected" : ""?>>Select Time Schedule</option>
                                        <?php if($subject['Units'] == 3.0):?>
                                            <option value="AM 7:30 - 10:30" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "AM 7:30 - 10:30") : ""?>>AM 7:30 - 10:30</option>
                                            <option value="AM 10:30 - 1:30" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "AM 10:30 - 1:30") : ""?>>AM 10:30 - 1:30</option>
                                            <option value="PM 2:00 - 5:00" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "PM 2:00 - 5:00") : ""?>>PM 2:00 - 5:00</option>
                                            <option value="PM 5:00 - 8:00" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "PM 5:00 - 8:00") : ""?>>PM 5:00 - 8:00</option>
                                            <option value="PM 5:30 - 8:30" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "PM 5:30 - 8:30") : ""?>>PM 5:30 - 8:30</option>
                                        <?php elseif($subject['Units'] == 5.0):?>
                                            <option value="AM 7:30 - 10:30" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "AM 7:30 - 10:30") : ""?>>AM 7:30 - 10:30</option>
                                            <option value="PM 2:00 - 7:00" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "PM 2:00 - 7:00") : ""?>>PM 2:00 - 7:00</option>
                                        <?php else: ?>
                                            <option value="AM 7:30 - 9:30" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "AM 7:30 - 9:30") : ""?>>AM 7:30 - 9:30</option>
                                            <option value="AM 10:00 - 12:00" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "AM 10:00 - 12:00") : ""?>>AM 10:00 - 12:00</option>
                                            <option value="PM 2:00 - 4:00" <?php echo ($numOfStudent <= 30) ? selectTime($subjectSection, "PM 2:00 - 4:00") : ""?>>PM 2:00 - 4:00</option>
                                        <?php endif; ?>
                                    </select>
                                </td>

                                <td><?php echo $subject['Units']?></td>
                                <td>₱<?php echo $subject['SubjectFee']?></td>
                            </tr>
                            <?php $tuitionFee += $subject['SubjectFee']; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <!-- Miscellaneous -->
                <div class="row">
                    <div class="col-4">
                        <table>
                            <?php for($i = 0; $i <= 1; $i++): ?>
                                <tr>
                                    <td><?php echo $misc[$i]['Miscellaneous']?></td>
                                    <td>₱<?php echo $misc[$i]['Fee']?></td>
                                </tr>
                                <?php $miscFee += $misc[$i]['Fee']; ?>
                            <?php endfor ?>
                        </table>
                    </div>
                    <div class="col-4">
                        <table>
                            <?php for($i = 2; $i <= 3; $i++): ?>
                                <tr>
                                    <td><?php echo $misc[$i]['Miscellaneous']?></td>
                                    <td>₱<?php echo $misc[$i]['Fee']?></td>
                                </tr>
                                <?php $miscFee += $misc[$i]['Fee']; ?>
                            <?php endfor ?>
                        </table>
                    </div>
                    <div class="col-4">
                        <table>
                            <?php for($i = 4; $i <= 4; $i++): ?>
                                <tr>
                                    <td><?php echo $misc[$i]['Miscellaneous']?></td>
                                    <td>₱<?php echo $misc[$i]['Fee']?></td>
                                </tr>
                                <?php $miscFee += $misc[$i]['Fee']; ?>
                            <?php endfor ?>
                        </table>
                    </div>
                </div>

                <!-- Fee Details -->
                <?php if($address['Residency'] == "non-marikina"): //If non marikenyo?>
                    <table class="mt-5 fee-details">
                        <tr>
                            <td>Tuition Fee:</td>
                            <td>₱ <?php echo $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous Fee:</td>
                            <td>₱ <?php echo $miscFee?></td>
                        </tr>
                        <tr>
                            <td>Total Assessment Fee:</td>
                            <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                        </tr>
                    </table>
                <?php else:  //If marikenyo?>
                    <table class="mt-5 fee-details">
                        <tr>
                            <td>Tuition Fee:</td>
                            <td>₱ <?php echo $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Miscellaneous Fee:</td>
                            <td>₱ <?php echo $miscFee ?></td>
                        </tr>
                        <tr>
                            <td>Total Assessment Fee:</td>
                            <td>₱ <?php echo $miscFee + $tuitionFee?></td>
                        </tr>
                        <tr>
                            <td>Residency Discount:</td>
                            <td>₱ <?php echo 300 - ($miscFee + $tuitionFee);?></td>
                        </tr>
                        <tr>
                            <td>Amount Due:</td>
                            <td>₱ 300</td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <button id="btn-encode-subject" class="plmar-btn mt-3 d-block mx-auto">Encode Subjects</button>
    </div>
</div>

<script src="../js/dean.encoded-student-subjects.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>