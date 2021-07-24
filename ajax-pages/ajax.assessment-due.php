<?php
    session_start();
    include '../includes/classloader.php';
    $selectObj = new Select();

    $totalUnits = 0;

    $academicInfo = $selectObj->getStudentAcademicInfoByStudentAndSchoolYear($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year'));
    $assessment = $selectObj->getAssessmentDuesByAcademicIDAndAssessment($_POST['academic-id'], $_POST['assessment']);
    $address = $selectObj->getAddressByID($_SESSION['USER_ID']);

    if(is_array($academicInfo)){
        $subjects = $selectObj->getStudentClassByStudentIDSchoolYearSemester($_SESSION['USER_ID'], $academicInfo['SchoolYear'], $academicInfo['Semester']);
    
        foreach($subjects as $sub){
            $totalUnits += $sub['Units'];
        }
    }
?>

<style>
    .table-container{
        height: fit-content;
        border: none;
    }
</style>
<div class="table-container">
    <table class="table table-bordered mx-auto" style="width: 700px;">
        <tr>
            <td class="title">Assessment Status:</td>
            <td class="phar"><?php echo $assessment['Assessment']?></td>
        </tr>
        <tr>
            <td class="title">Residency:</td>
            <td class="phar"><?php echo strtoupper($address['Residency'])?></td>
        </tr>
        <tr>
            <td class="title">Total Units Enrolled:</td>
            <td class="phar"><?php echo $totalUnits?></td>
        </tr>
        <tr>
            <td class="title">Remaining Tuition Fee:</td>
            <td class="phar">₱ <?php echo $assessment['TuitionFee']?></td>
        </tr>
        <tr>
            <td class="title">Remaining Miscellaneous Fee:</td>
            <td class="phar">₱ <?php echo $assessment['MiscFee']?></td>
        </tr>
        <tr>
            <td class="title">Total Amount Due:</td>
            <td class="phar">₱ <?php echo $assessment['MiscFee'] + $assessment['TuitionFee']?></td>
        </tr>
    </table>
</div>