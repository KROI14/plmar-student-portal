<?php
    function arrPrint($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';

    $academicLevel = $selectObj->getStudentAcademicInformationByStudentID($_SESSION['USER_ID']);
    $course = $selectObj->getCourseByCourseID($academicLevel['CourseID']);

    $subjects = $selectObj->getSubjectCourseByCourse($academicLevel['CourseID']);
    $totalUnits = 0;
    $totalUnitsTaken = 0;

    for($i = 0; $i < count($subjects); $i++){
        $grade = $selectObj->getSubjectGradeByStudentIDAndSubjectCode($_SESSION['USER_ID'], $subjects[$i]['SubjectCode'], "approved");
        $taken = "";
        if(is_array($grade)){
            $taken = $subjects[$i]['Units'];
            $totalUnitsTaken += $taken;
            $grade = $grade['Grade'];
        }
        $totalUnits += $subjects[$i]['Units'];
    }

    $enrolledSubs = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));
    $creditedSubs = $selectObj->getStudentCreditedSubjectsStudentIDNotSchoolYearSemester($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year'), $selectObj->getControl('enrollment-semester'));

    $minorSubs = $selectObj->getSubjectCourseByCourseAndType($academicLevel['CourseID'], "minor");
    $majorSubs = $selectObj->getSubjectCourseByCourseAndType($academicLevel['CourseID'], "major");
?>

<link rel="stylesheet" href="../css/stud.check-list.css?v=<?php echo time()?>">

<div class="container-fluid py-3">
    <div class="card-container">
        <table class="student-info">
            <tr>
                <td>Student ID: </td>
                <td><?php echo $_SESSION['USER_ID']; ?></td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><?php echo $user['Lastname'] . ", " . $user['Firstname'] . " " . $user['Middlename']; ?></td>
            </tr>
            <tr>
                <td>Course: </td>
                <td><?php echo $course['Course']?></td>
            </tr>
            <tr>
                <td>Year level: </td>
                <td><?php echo $academicLevel['YearLevel']?></td>
            </tr>
            <tr>
                <td>Total Units Required for this course: </td>
                <td><?php echo $totalUnits;?></td>
            </tr>
            <tr>
                <td>Total Units earned: </td>
                <td><?php echo $totalUnitsTaken;?></td>
            </tr>


            <tr class="enrolled-sub">
                <td class="text-center" colspan="2">Color indicates subjects are currently enrolled</td>
            </tr>
            <tr class="credited-sub">
                <td class="text-center" colspan="2">Color indicates subjects are credited</td>
            </tr>
            <tr class="enrolled-sub failed-sub">
                <td class="text-center" colspan="2">Color indicates back subject</td>
            </tr>
            <tr class="failed-sub">
                <td class="text-center" colspan="2">Color indicates failed subject</td>
            </tr>
        </table>
    </div>

    <div class="card-container mt-3">
        <label class="sub-header">Major Subjects</label>
        <div class="table-container">
            <table class="plmar-table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Grade/Remarks</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($majorSubs); $i++): ?>
                        <?php
                            $enrolledKey = array_search($majorSubs[$i]['SubjectCode'], array_column($enrolledSubs, "SubjectCode"));
                            $credited = array_search($majorSubs[$i]['SubjectCode'], array_column($creditedSubs, "SubjectCode"));
                            
                        ?>
                        <tr class="<?php
                                if($enrolledKey !== false){
                                    echo "enrolled-sub ";
                                }

                                if($credited !== false){
                                    $keyCredited = $credited;
                                    if($creditedSubs[$keyCredited]['Remarks'] == "Failed"){
                                        $keyCredited = $credited;
                                        echo "failed-sub";
                                    }
                                    else{
                                        $keyCredited = $credited;
                                        echo "credited-sub";
                                    }
                                }
                                else{
                                    $keyCredited = -1;
                                }
                             ?>">
                            <td><?php echo $majorSubs[$i]['SubjectCode']?></td>
                            <td><?php echo $majorSubs[$i]['Description']; ?></td>
                            <td><?php echo ($keyCredited >= 0) ? $creditedSubs[$keyCredited]['Remarks'] : ""?></td>
                            <td><?php echo $majorSubs[$i]['Units']?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-container mt-3">
        <label class="sub-header">Minor Subjects</label>
        <div class="table-container">
            <table class="plmar-table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Grade/Remarks</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($minorSubs); $i++): ?>
                        <?php
                            $enrolledKey = array_search($minorSubs[$i]['SubjectCode'], array_column($enrolledSubs, "SubjectCode"));
                            $credited = array_search($minorSubs[$i]['SubjectCode'], array_column($creditedSubs, "SubjectCode"));
                        ?>
                        <tr class="<?php
                                if($enrolledKey !== false){
                                    echo "enrolled-sub";
                                }
                                
                                if($credited !== false){
                                    $keyCredited = $credited;
                                    if($creditedSubs[$keyCredited]['Remarks'] == "Failed"){
                                        $keyCredited = $credited;
                                    }
                                    else{
                                        $keyCredited = $credited;
                                        echo "credited-sub";
                                    }
                                }
                                else{
                                    $keyCredited = -1;
                                }
                             ?>">
                            <td><?php echo $minorSubs[$i]['SubjectCode']?></td>
                            <td><?php echo $minorSubs[$i]['Description']; ?></td>
                            <td><?php echo ($keyCredited >= 0) ? $creditedSubs[$keyCredited]['Remarks'] : ""?></td>
                            <td><?php echo $minorSubs[$i]['Units']?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>