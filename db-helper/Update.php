<?php

class Update extends Connection{

    public function updateOldStudentEnrollmentStatus($studentID, $status){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE old_student_enrollment SET EnrollmentStatus = ? WHERE StudentID = ? ORDER BY EncodeID DESC LIMIT 1');
        $stmt->bind_param('ss', $status, $studentID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateGradeStatusByGradeID($gradeID, $status){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE student_grades SET Status = ? WHERE GradeID = ?');
        $stmt->bind_param('ss', $status, $gradeID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateClassToAddInstructor($adminID, $subjectID, $section, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE student_class SET AdminID = ? WHERE SubjectID = ? AND Section = ? AND SchoolYear = ?');
        $stmt->bind_param('ssss', $adminID, $subjectID, $section, $schoolYear);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateDownpaymentApprovalStatus($approvalID, $status){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE `downpayment_approval` SET Status = ? WHERE ApprovalID = ?');
        $stmt->bind_param('ss', $status, $approvalID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateAdmissionStatusByID($admissionID, $status){
        $con = $this->connect();
        
        $stmt = $con->prepare('UPDATE admission_info SET AdmissionStatus = ? WHERE AdmissionID = ?');
        $stmt->bind_param('ss', $status, $admissionID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateControls($control, $status){
        $con = $this->connect();

        $stmt = $con->prepare("UPDATE `enrollment_control` SET `Status`= ? WHERE Control = ?");
        $stmt->bind_param('ss', $status, $control);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }
    
    public function updateResidency($studentID, $residency){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE address SET Residency = ? WHERE StudentID = ?');
        $stmt->bind_param('ss', $residency, $studentID);
        $stmt->execute();
        $stmt->get_result();

        return $stmt->affected_rows;
    }

    public function updateEnrollmentAdmissionStatus($admissionID, $enrollStatus, $admissionStatus){
        $con = $this->connect();

        $stmt = $con->prepare("UPDATE `admission_info` SET EnrollStatus = ?, AdmissionStatus = ? WHERE AdmissionID = ?");
        $stmt->bind_param('sss', $enrollStatus, $admissionStatus, $admissionID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateAdmissionEntry($entry, $admissionID){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE admission_info SET Entry = ? WHERE AdmissionID = ?');
        $stmt->bind_param('ss', $entry, $admissionID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function updateEnrollmentStatus($status, $admissionID){
        $con = $this->connect();

        $stmt = $con->prepare('UPDATE admission_info SET EnrollStatus = ? WHERE AdmissionID = ?');
        $stmt->bind_param('ss', $status, $admissionID);
        $stmt->execute();
        $stmt->get_result();

        return $stmt->affected_rows;
    }

}