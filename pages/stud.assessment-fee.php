<?php
    include '../includes/header.inc.php';
    include '../includes/nav.inside-nav.php';
    
    $address = $selectObj->getAddressByID($_SESSION['USER_ID']);
    $academic = $selectObj->getStudentAcademicInformationByStudentID($_SESSION['USER_ID']);

    $isEnrolled = is_array($selectObj->getStudentAcademicInfoByStudentAndSchoolYear($_SESSION['USER_ID'], $selectObj->getControl('enrollment-school-year')));

    $midterm = $selectObj->getAssessmentDuesByAcademicIDAndAssessment($academic['AcademicID'], "Midterm Assessment");
    $final = $selectObj->getAssessmentDuesByAcademicIDAndAssessment($academic['AcademicID'], "Final Assessment");
    $downpayment = $selectObj->getOfficialDownpaymentByAcademicID($academic['AcademicID']);

    $course = $selectObj->getCourseByCourseID($academic['CourseID']);
?>

<style>
    .payment-check-list{
        display: none;
    }
</style>

<div class="container-fluid py-3">
    <div class="payment-check-list m-5">
        <img src="../img/logo_plmar.jpg" width="90px" height="90px" class="rounded-circle float-start me-3">
        <p class="title m-0 mt-1">Pamantasan ng Lungsod ng marikina</p>
        <p class="phar m-0">Brazil St., Greenheights Subdivision, Marikina, 1800 Metro Manila</p>
        <p class="title m-0">Payment Checklist</p>
        <p class="phar m-0"><?php echo $selectObj->getControl("enrollment-school-year"); ?></p>

        <table class="table table-bordered mt-3">
            <tr>
                <td class="title">Name: <span class="phar"><?php echo $user['Lastname'] . " " . $user['Firstname'] . " " . $user['Middlename']?><span></td>
                <td class="title">Student's Signature: </td>
            </tr>
            <tr>
                <td class="title" colspan="2">Course: <span class="phar"><?php echo $course['Abbreviation']?></span></td>
            </tr>
            <tr>
                <td class="title" colspan="2">Residency: <span class="phar"><?php echo $address['Residency']?></span></td>
            </tr>
            <tr>
                <td class="title" colspan="2">Year Level: <span class="phar"><?php echo $academic['YearLevel']?></span></td>
            </tr>
        </table>

        <table class="table table-bordered mt-5">
            <tr>
                <td class="title">Payment Mode: </td>
                <td class="phar"><?php echo $downpayment['PaymentMode'];?></td>
            </tr>
            <tr>
                <td class="title">Balance:</td>
                <td class="phar">₱ <?php echo $downpayment['AmountPaid']; ?></td>
            </tr>
            <tr>
                <td class="title">Date Paid:</td>
                <td class="phar"></td>
            </tr>
            <tr>
                <td class="title">Bursar's Signature:</td>
                <td class="phar"></td>
            </tr>
        </table>

        <table class="table table-bordered mt-5">
            <tr>
                <td class="title">Assessment Due: </td>
                <td class="phar"><?php echo $midterm['Assessment'];?></td>
            </tr>
            <tr>
                <td class="title">Balance:</td>
                <td class="phar">₱ <?php echo $midterm['TuitionFee'] + $midterm['MiscFee']; ?></td>
            </tr>
            <tr>
                <td class="title">Date Paid:</td>
                <td class="phar"></td>
            </tr>
            <tr>
                <td class="title">Bursar's Signature:</td>
                <td class="phar"></td>
            </tr>
        </table>

        <table class="table table-bordered mt-5">
            <tr>
                <td class="title">Assessment Due: </td>
                <td class="phar"><?php echo $final['Assessment'];?></td>
            </tr>
            <tr>
                <td class="title">Balance:</td>
                <td class="phar">₱ <?php echo $final['TuitionFee'] + $final['MiscFee']; ?></td>
            </tr>
            <tr>
                <td class="title">Date Paid:</td>
                <td class="phar"></td>
            </tr>
            <tr>
                <td class="title">Bursar's Signature:</td>
                <td class="phar"></td>
            </tr>
        </table>
    </div>

    <div class="card-container">
        <?php if($address['Residency'] == "marikina" || $downpayment['PaymentMode'] == "Full Payment"): ?>
            <p class="title">Payment</p>
        <?php else: ?>
            <p class="title">Downpayment</p>
        <?php endif; ?>

        <table class="table table-bordered mx-auto" style="max-width:700px">
            <tr>
                <td class="title">Payment Mode: </td>
                <td class="phar"><?php echo $downpayment['PaymentMode'];?></td>
            </tr>
            <tr>
                <td class="title">Balance:</td>
                <td class="phar">₱ <?php echo $downpayment['AmountPaid']; ?></td>
            </tr>
        </table>
    </div>

    <div class="card-container mt-3">
        <p class="title mb-0">Midterm Due</p>
        <div class="midterm-due">
        </div>
    </div>

    <div class="card-container mt-3">
        <p class="title mb-0">Final Due</p>
        <div class="finals-due">
        </div>
    </div>

    <?php if($isEnrolled): ?>
        <div class="card-container mt-3 text-center">
            <button class="btn btn-primary" id="btn-download">Download Payment Checklist</button>
        </div>
    <?php endif; ?>
</div>

<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    $(function(){
        $('.midterm-due').load('../ajax-pages/ajax.assessment-due.php',{
            'assessment': "Midterm Assessment",
            'academic-id': "<?php echo $academic['AcademicID']?>"
        });

        $('.finals-due').load('../ajax-pages/ajax.assessment-due.php',{
            'assessment': "Final Assessment",
            'academic-id': "<?php echo $academic['AcademicID']?>"
        });
        
        $("#btn-download").on('click', function(){
            var element = $('.payment-check-list').clone().css('display', 'block');
            var opt = {
                margin:       1,
                filename:     'payment-checklist.pdf',
                jsPDF:        {orientation: 'portrait' }
            };
            
            html2pdf().set(opt).from($(element)[0]).save();
        });
    });
</script>
<script>

    
</script>
<?php
    include '../includes/footer.inc.php';
?>