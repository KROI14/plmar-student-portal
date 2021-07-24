<?php

    include '../includes/classloader.php';
    
    $insertObj = new Insert();
    $updateObj = new Update();
    $selectObj = new Select();

    $rmngMisc = 0;
    $rmngTuition = 0;

    $assessment = ["Midterm Assessment", "Final Assessment"];
    
    if($_POST['status'] == "approved"){
        $amountPaid = $_POST['amount-paid'];
        //$datePaid = $_POST['date-paid'];
        $paymentMode = $_POST['payment-mode'];
        $academicID = $_POST['academic-id'];
        //$approvalID = $_POST['approval-id'];
        $tuitionFee = $_POST['tuition-fee'];
        $miscFee = $_POST['misc-fee'];
        $residency = $_POST['residency'];
    
        if($residency == "non-marikina"){
            if($paymentMode == "Installment"){
                $totalFee = $tuitionFee + $miscFee;
    
                $tuitionPercent = ($tuitionFee * 100) / $totalFee;
                $miscPercent = 100 - $tuitionPercent;
    
                $tuitionPercent = $tuitionPercent / 100;
                $miscPercent = $miscPercent / 100;
    
                $totalFee = ($totalFee - $amountPaid) / 2;
                
                $rmngTuition = $totalFee * $tuitionPercent;
                $rmngMisc = $totalFee * $miscPercent;
            }
            else{
                $rmngMisc = 0;
                $rmngTuition = 0;
            }
        }
        else{
            $rmngMisc = 0;
            $rmngTuition = 0;
        }

        $insertObj->setOfficialDownpayment($_POST['academic-id'], $_POST['amount-paid'], $_POST['payment-mode'], "");
        for($i = 0; $i < count($assessment); $i++){
            $assessmentID = $selectObj->getIncrementedID('assessment_due', 'AssessmentID');
            $insertObj->setAssessmentDue($assessmentID, $academicID, $assessment[$i], $rmngTuition, $rmngMisc);
        }
        //$updateObj->updateDownpaymentApprovalStatus($_POST['approval-id'], $_POST['status']);
        $updateObj->updateEnrollmentStatus("account registration", $_POST['admission-id']);

        $updateRes = $updateObj->updateOldStudentEnrollmentStatus($_POST['student-id'], "finish");
        echo "success - approved";
    }
    else{
        $updateObj->updateDownpaymentApprovalStatus($_POST['approval-id'], $_POST['status']);
        $updateObj->updateEnrollmentStatus("payment", $_POST['admission-id']);
        
        $updateObj->updateOldStudentEnrollmentStatus($_POST['student-id'], "payment");
        echo "success - rejected";
    }
?>