<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';

    $pdf = $selectObj->getAdmissionInfoForPDF($_GET['admid']);
?>

<link rel="stylesheet" href="../css/admission-result.css?v=<?php echo time()?>">

<div id="pdf">
    <img src="../img/logo_plmar.jpg" width="90px" height="90px" class="rounded-circle float-start me-3">
    <p class="title m-0 mt-1">Pamantasan ng Lungsod ng marikina</p>
    <p class="phar m-0">Brazil St., Greenheights Subdivision, Marikina, 1800 Metro Manila</p>
    <p class="title m-0">Application Form for Admission</p>
    <p class="phar m-0"><?php echo $selectObj->getControl("enrollment-school-year"); ?></p>

    <div class="stud-img">
        1x1 picture
    </div>

    <main class="mt-5">
        <p class="title mb-0 ms-3">Student Information</p>
        <hr class="m-0">
        <table>
            <tr>
                <td class="phar">Name:</td>
                <td class="title"><?php echo $pdf['Lastname'] . ", " . $pdf['Middlename'] . " " . $pdf['Firstname']?></td>
                <td class="phar">Email:</td>
                <td class="title"><?php echo $pdf['Email']?></td>
            </tr>
            <tr>
                <td class="phar">Address:</td>
                <td class="title"><?php echo $pdf['HouseNo'] . ", " . $pdf['Street'] . ", " . $pdf['Barangay'] . ", " . $pdf['City'] . " " . $pdf['Province']?></td>
                <td class="phar">Contact No.:</td>
                <td class="title"><?php echo $pdf['ContactNo']?></td>
            </tr>
            <tr>
                <td class="phar">Birthdate:</td>
                <td class="title"><?php echo $pdf['Birthdate']?></td>
            </tr>
        </table>

        <p class="title mb-0 ms-3 mt-5">Contact Person Information</p>
        <hr class="m-0">
        <table>
            <tr>
                <td class="phar">Name:</td>
                <td class="title"><?php echo $pdf['confName'] . " " . $pdf['conlName']?></td>
            </tr>
            <tr>
                <td class="phar">Email:</td>
                <td class="title"><?php echo $pdf['conEmail']?></td>
            </tr>
            <tr>
                <td class="phar">Contact No.:</td>
                <td class="title"><?php echo $pdf['conContactNo']?></td>
            </tr>
        </table>

        <p class="title mb-0 ms-3 mt-5">Admission Information</p>
        <hr class="m-0">
        <table>
            <tr>
                <td class="phar">Admission No.:</td>
                <td class="title"><?php echo $pdf['AdmissionID']?></td>
            </tr>
            <tr>
                <td class="phar">Control No.:</td>
                <td class="title"><?php echo $pdf['ControlNo']?></td>
            </tr>
            <tr>
                <td class="phar">Entry:</td>
                <td class="title"><?php echo $pdf['Entry']?></td>
            </tr>
            <tr>
                <td class="phar">Preferred Course:</td>
                <td class="title"><?php echo $pdf['PreferredCourse']?></td>
            </tr>
            <tr>
                <td class="phar">Submitted Date/Time:</td>
                <td class="title"><?php echo date("F j, Y, g:i a", strtotime($pdf['CreatedAt']))?></td>
            </tr>
            <tr>
                <td class="phar">School Year:</td>
                <td class="title"><?php echo $pdf['SchoolYear']?></td>
            </tr>
        </table>

        <p class="mt-5 mx-5 mb-5">
            <span class="title">I hereby certify that all the information stated above are true and correct</span>
            <span class="phar">
                as to the best of my knowledge. I hereby give consent for my personal data included in my offer
                to processed for the purposes of admission and enrollment in accordance with Republic Act 10173 -
                Data Privacy Act of 2012.
            </span>
        </p>

        <div class="underline pb-5"></div>
        <p class="title text-center">Signature over printed name</p>
    </main>
</div>

<div class="container py-3">
    <p class="sub-header mb-0 px-lg-4">Application Form for Admission</p>
    <p class="phar px-lg-4">Your admission has been successfully submitted to the admission office.
    Wait for 3 to 5 days for the approval of your admission. Download and print the admission
    form application for you to have a copy for future use. Also, keep your control no. For 
    your online enrollment. You can check the status of your admission in the Admission List Page</p>
    <hr>
    
    <section>
        <div class="row">
            <div class="col-12 col-lg-6">
                <label class="title">Student Information</label>
                <p class="phar ms-4 text-success"><i class="far fa-check-circle"></i> Success</p>

                <label class="title">Address Information</label>
                <p class="phar ms-4 text-success"><i class="far fa-check-circle"></i> Success</p>

                <label class="title">Contact Person Information</label>
                <p class="phar ms-4 text-success"><i class="far fa-check-circle"></i> Success</p>

                <label class="title">Admission Information</label>
                <p class="phar ms-4 text-success"><i class="far fa-check-circle"></i> Success</p>
            </div>

            <div class="col-12 col-lg-6">
                <div class="jumbotron mt-4 mt-lg-0">
                    <p class="title mb-2 text-center">Your Control Number is</p>
                    <p class="sub-header mb-0 text-center text-success"><?php echo $pdf['ControlNo']?></p>

                    <hr>

                    <p class="title mb-2 text-center">Download your application form</p>
                    <div class="text-center">
                        <button class="plmar-btn" id="btn-download">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script src="../js/admission-result.js?v=<?php echo time()?>"></script>

<?php
    include '../includes/footer.inc.php';
?>