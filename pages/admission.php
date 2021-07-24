<?php
    include '../includes/header.inc.php';
    include '../includes/nav.outside-nav.php';
?>

<link rel="stylesheet" href="../css/admission.css?v=<?php echo time()?>">

<div class="container py-5">
    <?php if(isset($_GET['page'])):?>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] == "list") ? "active" : ""?>" href="admission.php?page=list">Admissions List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] == "form") ? "active" : ""?>"  href="admission.php?page=form">Admission Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['page'] == "old-enrollment") ? "active" : ""?>"  href="admission.php?page=old-enrollment">Enrollment for Old Student</a>
            </li>
        </ul>


        <?php if($_GET['page'] == "list"): ?>

            <!-- List of On Process admissions -->
            <?php
                $schoolYear = $selectObj->getControl("enrollment-school-year");
                $onProcess = $selectObj->getAdmissionDataForTable($schoolYear, "", "on process", "", ""); ?>
            <label class="title mt-5">On Process Admissions</label>
            <div class="table-container">
                <table class="plmar-table plmar-table-hover">
                    <thead>
                        <tr>
                            <th>Admission No.</th>
                            <th>Name</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody id="table-on-process">
                        <?php for($i = 0; $i < count($onProcess); $i++): ?>
                            <tr data-admission-id="<?php echo $onProcess[$i]['AdmissionID']?>">
                                <td><?php echo $onProcess[$i]['AdmissionID']?></td>
                                <td><?php echo $onProcess[$i]['Lastname'] . ", " . $onProcess[$i]['Firstname'] . " " . $onProcess[$i]['Middlename']?></td>
                                <td><?php echo date('F j, Y', strtotime($onProcess[$i]['CreatedAt']))?></td>
                            </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            </div>

            <!-- List of Approved Admissions -->
            <?php
                $schoolYear = $selectObj->getControl("enrollment-school-year");
                $approved = $selectObj->getAdmissionDataForTable($schoolYear, "payment", "approved", "", ""); ?>
            <label class="title mt-5">Approved Admissions</label>
            <div class="table-container">
                <table class="plmar-table plmar-table-hover">
                    <thead>
                        <tr>
                            <th>Admission No.</th>
                            <th>Name</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody id="table-approved">
                        <?php for($i = 0; $i < count($approved); $i++): ?>
                            <tr data-student-id="<?php echo $approved[$i]['StudentID']; ?>" data-control-no="<?php echo $approved[$i]['ControlNo']?>">
                                <td><?php echo $approved[$i]['AdmissionID']?></td>
                                <td><?php echo $approved[$i]['Lastname'] . ", " . $approved[$i]['Firstname'] . " " . $approved[$i]['Middlename']?></td>
                                <td><?php echo date('F j, Y', strtotime($approved[$i]['CreatedAt']))?></td>
                            </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            </div>

            <!-- List of Rejected Admissions -->
            <?php
                $schoolYear = $selectObj->getControl("enrollment-school-year");
                $rejected = $selectObj->getAdmissionDataForTable($schoolYear, "none", "rejected", "", ""); ?>
            <label class="title mt-5">Rejected Admissions</label>
            <div class="table-container">
                <table class="plmar-table plmar-table-hover">
                    <thead>
                        <tr>
                            <th>Admission No.</th>
                            <th>Name</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody id="table-rejected">
                        <?php for($i = 0; $i < count($rejected); $i++): ?>
                            <tr data-admission-id="<?php echo $rejected[$i]['AdmissionID']?>">
                                <td><?php echo $rejected[$i]['AdmissionID']?></td>
                                <td><?php echo $rejected[$i]['Lastname'] . ", " . $rejected[$i]['Firstname'] . " " . $onProcess[$i]['Middlename']?></td>
                                <td><?php echo date('F j, Y', strtotime($rejected[$i]['CreatedAt']))?></td>
                            </tr>
                        <?php endfor;?>
                    </tbody>
                </table>
            </div>
        
        <?php elseif($_GET['page'] == "old-enrollment"):?>
            
            <?php if($selectObj->getControl('enrollment-status') == "Close"): ?>
                <p class="sub-header text-danger">The Enrollment for old students is temporarily close. Kindly contact our hotline for more information</p>
            <?php endif; ?>

            <div class="card-container mt-5 mx-auto" style="max-width: 400px;">
                <p class="title mb-0">Student ID</p>
                <input type="text" class="plmar-input text-center" id="student-id">

                <p class="title mb-0 mt-3">Username</p>
                <input type="text" class="plmar-input text-center" id="username">

                <p class="title mb-0 mt-3">Password</p>
                <input type="password" class="plmar-input text-center" id="password">

                <div class="text-center mt-3">
                    <?php if($selectObj->getControl('enrollment-status') == "Open"): ?>
                        <button class="plmar-btn" id="btn-enter-old-enrollment">Enter</button>
                    <?php endif; ?>
                </div>
            </div>

        <?php else: ?>

            <form class="admission-form mt-4" id="form-input">
                <?php if($selectObj->getControl('enrollment-status') == "Close"): ?>
                    <p class="sub-header text-danger">The admission for new/transferee students are temporarily close. Kindly contact our hotline for more information</p>
                <?php endif; ?>

                <p class="sub-header mb-0">Student Information</p>

                <div class="img-profile-container img-thumbnail">
                    <img src="../img/img_profile_placeholder.jpg" width="100%" id="student-img">
                </div>
                <div class="text-center mt-1">
                    <label class="plmar-btn" for="input-img-file"><i class="far fa-image"></i> Upload Image</label>
                    <input type="file" id="input-img-file" name="input-img-file" class="d-none" accept="image/*"
                        onchange="document.getElementById('student-img').src = window.URL.createObjectURL(this.files[0])"
                        name="img-file">
                </div>

                <label class="title">Name</label>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input" placeholder="Firstname" name="txt-fName">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Middlename" name="txt-mName">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Lastname" name="txt-lName">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-lg-4">
                        <label class="title mt-3 mt-lg-0">Gender</label>
                        <br>
                        <input type="radio" name="rb-gender" value="Male" id="male" class="me-1 ms-2" checked><label for="male">Male</label>
                        <br>
                        <input type="radio" name="rb-gender" value="Female" id="female" class="me-1 ms-2"><label for="female">Female</label>
                        <br>
                        <input type="radio" name="rb-gender" value="Non Binary" id="non-binary" class="me-1 ms-2"><label for="non-binary">Non Binary</label>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-lg-4">
                        <label class="title">Email</label>
                        <input type="text" class="plmar-input" name="txt-email">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="title mt-3 mt-lg-0" name="txt-contact">Contact no.</label>
                        <div class="d-flex align-items-center">
                            +63<input type="text" class="plmar-input ms-1" name="txt-contact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="title mt-3 mt-lg-0" name="txt-contact">Birthdate</label>
                        <input type="date" class="plmar-input" name="txt-birthdate" max="2005-12-31">
                    </div>
                </div>


                <p class="sub-header mt-5 mb-0">Address Information</p>

                <div class="row">
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input" placeholder="House no" name="txt-house-no">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Street" name="txt-street">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Barangay" name="txt-brgy">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3" placeholder="City" name="txt-city">
                    </div>
                    <div class="col-12 col-lg-4">
                        <input type="text" class="plmar-input mt-3" placeholder="Province" name="txt-province">
                    </div>
                </div>

                <p class="sub-header mt-5 mb-0">Contact Person Information</p>

                <label class="title">Name</label>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <input type="text" class="plmar-input" placeholder="Firstname" name="txt-con-fName">
                    </div>
                    <div class="col-12 col-lg-6">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Lastname" name="txt-con-lName">
                    </div>
                </div>


                <label class="title mt-4">Contact Information</label>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="d-flex align-items-center">
                            +63<input type="text" class="plmar-input ms-1" name="txt-con-contact" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input type="text" class="plmar-input mt-3 mt-lg-0" placeholder="Email" name="txt-con-email">
                    </div>
                </div>

                <p class="sub-header mt-4 mb-0">Admission Information</p>
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <label class="title">Entry</label>
                        <select class="plmar-input" name="select-entry" id="select-entry">
                            <option value="">Select Entry</option>
                            <option value="New Student">New Student</option>
                            <option value="Transferee">Transferee</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-5">
                        <?php $courses = $selectObj->getCourses(); ?>
                        <label class="title mt-3 mt-lg-0">Preferred Course</label>
                        <select class="plmar-input" name="select-course">
                            <option value="">Select Course</option>
                            <?php for($i = 0; $i < count($courses); $i++): ?>
                                <option value="<?php echo $courses[$i]['Course']?>"><?php echo $courses[$i]['Course']?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <p class="sub-header mt-5 mb-0">Required Documents</p>
                <ul class="phar">
                    <li>Scanned copy of Form 138 (Report Card) or GWA Certificate of Grade 11 (1st and 2nd Sem) and Grade 12 (1st Sem)</li>
                    <li>Scanned copy of Certificate of Good Moral Character</li>
                    <li>Scanned proof of billing</li>
                    <li>Admission Essay in PDF Format</li>
                    <li>Scanned Transfer Credentials(For Transferees)</li>
                </ul>
                
                <!-- <button class="plmar-btn" id="btn-upload-files" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="file" id="input-files" name="input-files[]" class="d-none" multiple> -->
            </form>

            <div class="input-group mb-3">
                <button class="plmar-btn" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="text" class="form-control" placeholder="Form 138" readonly>
                <input type="file" class="d-none input-file" id="file-form-138" name="input-files[]" form="form-input">
            </div>

            <div class="input-group mb-3">
                <button class="plmar-btn" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="text" class="form-control" placeholder="Good Moral Character" readonly>
                <input type="file" class="d-none input-file" id="file-good-moral" name="input-files[]" form="form-input">
            </div>

            <div class="input-group mb-3">
                <button class="plmar-btn" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="text" class="form-control" placeholder="Proof of Billing" readonly>
                <input type="file" class="d-none input-file" id="file-proof-of-billing" name="input-files[]" form="form-input">
            </div>

            <div class="input-group mb-3">
                <button class="plmar-btn" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="text" class="form-control" placeholder="Admission Essay" readonly>
                <input type="file" class="d-none input-file" id="file-admission-essay" name="input-files[]" form="form-input">
            </div>

            <div class="input-group mb-3">
                <button class="plmar-btn" type="button"><i class="fas fa-file-upload"></i> Upload File</button>
                <input type="text" class="form-control" placeholder="Transfer Credentials" readonly>
                <input type="file" class="d-none input-file" id="file-transfer-credentials" name="input-files[]" form="form-input">
            </div>
            
            <?php if($selectObj->getControl('enrollment-status') != "Close"): ?>
                <div class="text-center">
                    <button class='plmar-btn' id="btn-submit-form">Submit Form</button>
                </div>
            <?php endif; ?>

        <?php endif;?>

    <?php else:?>

        <p class="header">404 Page not found</p>
        <p class="phar">The requested URL was not found on this server</p>

    <?php endif;?>
</div>

<div class="modal fade" id="admission-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Terms and conditions -->
<!-- Modal -->
<div class="modal fade" id="terms-conditions" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
            </div>
            <div class="modal-body">
                <p class="phar">Last updated: July 20, 2021</p>
                <p class="phar">Please read these terms and conditions carefully before using Our Service.</p>
                <h1 class="sub-header">Interpretation and Definitions</h1>
                <h2 class="title">Interpretation</h2>
                <p class="phar">The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
                <h2 class="title">Definitions</h2>
                <p class="phar">For the purposes of these Terms and Conditions:</p>
                <ul>
                <li>
                <p class="phar"><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</p>
                </li>
                <li>
                <p class="phar"><strong>Country</strong> refers to:  Philippines</p>
                </li>
                <li>
                <p class="phar"><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Pamantasan ng Lungsod ng Marikina.</p>
                </li>
                <li>
                <p class="phar"><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
                </li>
                <li>
                <p class="phar"><strong>Service</strong> refers to the Website.</p>
                </li>
                <li>
                <p class="phar"><strong>Terms and Conditions</strong> (also referred as &quot;Terms&quot;) mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service. This Terms and Conditions agreement has been created with the help of the <a href="https://www.termsfeed.com/terms-conditions-generator/" target="_blank">Terms and Conditions Generator</a>.</p>
                </li>
                <li>
                <p class="phar"><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</p>
                </li>
                <li>
                <p class="phar"><strong>Website</strong> refers to Pamantasan ng Lungsod ng Marikina, accessible from <a href="https://plmar.edu.ph/" rel="external nofollow noopener" target="_blank">https://plmar.edu.ph/</a></p>
                </li>
                <li>
                <p class="phar"><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
                </li>
                </ul>
                <h1 class="sub-header">Acknowledgment</h1>
                <p class="phar">These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
                <p class="phar">Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>
                <p class="phar">By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.</p>
                <p class="phar">You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>
                <p class="phar">Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>
                <h1 class="sub-header">Links to Other Websites</h1>
                <p class="phar">Our Service may contain links to third-party web sites or services that are not owned or controlled by the Company.</p>
                <p class="phar">The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>
                <p class="phar">We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services that You visit.</p>
                <h1 class="sub-header">Termination</h1>
                <p class="phar">We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>
                <p class="phar">Upon termination, Your right to use the Service will cease immediately.</p>
                <h1 class="sub-header">Limitation of Liability</h1>
                <p class="phar">Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven't purchased anything through the Service.</p>
                <p class="phar">To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
                <p class="phar">Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party's liability will be limited to the greatest extent permitted by law.</p>
                <h1 class="sub-header">&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h1>
                <p class="phar">The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>
                <p class="phar">Without limiting the foregoing, neither the Company nor any of the company's provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
                <p class="phar">Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>
                <h1 class="sub-header">Governing Law</h1>
                <p class="phar">The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
                <h1 class="sub-header">Disputes Resolution</h1>
                <p class="phar">If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>
                <h1 class="sub-header">For European Union (EU) Users</h1>
                <p class="phar">If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which you are resident in.</p>
                <h1 class="sub-header">United States Legal Compliance</h1>
                <p class="phar">You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
                <h1 class="sub-header">Severability and Waiver</h1>
                <h2 class="title">Severability</h2>
                <p class="phar">If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>
                <h2 class="title">Waiver</h2>
                <p class="phar">Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Terms shall not effect a party's ability to exercise such right or require such performance at any time thereafter nor shall be the waiver of a breach constitute a waiver of any subsequent breach.</p>
                <h1 class="sub-header">Translation Interpretation</h1>
                <p class="phar">These Terms and Conditions may have been translated if We have made them available to You on our Service.
                You agree that the original English text shall prevail in the case of a dispute.</p>
                <h1 class="sub-header">Changes to These Terms and Conditions</h1>
                <p class="phar">We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
                <p class="phar">By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.</p>
                <h1 class="sub-header">Contact Us</h1>
                <p class="phar">If you have any questions about these Terms and Conditions, You can contact us:</p>
                <ul>
                    <li>By visiting this page on our website: <a href="https://plmar.edu.ph/" rel="external nofollow noopener" target="_blank">https://plmar.edu.ph/</a></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="plmar-btn" data-bs-dismiss="modal">I agree</button>
                <button type="button" class="plmar-btn" onclick="window.location.replace('../pages/index.php')">Decline</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/admission.js?v=<?php echo time()?>"></script>
<?php
    include '../includes/footer.inc.php';
?>