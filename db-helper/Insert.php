<?php

class Insert extends Connection{

    public function setOldStudentToEncodeSubject($encodeID, $studentID, $enrollStatus, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `old_student_enrollment`(`EncodeID`, `StudentID`, `EnrollmentStatus`, `SchoolYear`) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $encodeID, $studentID, $enrollStatus, $schoolYear);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setAnnouncement($adminID, $title, $content, $type){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `announcement`(`AdminID`, `Title`, `Content`, `Type`) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $adminID, $title, $content, $type);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setGradesEncodingSchedule($startingDate, $endingDate, $schoolYear, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `grades_encode_sched`(`StartingDateTime`, `EndingDateTime`, `SchoolYear`, `Semester`) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $startingDate, $endingDate, $schoolYear, $semester);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setStudentAccount($studentID, $username, $password){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `student_account`(`StudentID`, `Username`, `Password`) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $studentID, $username, $password);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }
    
    public function setAssessmentDue($assessmentID, $academicID, $assessment, $rmngTuition, $rmngMisc){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `assessment_due`(`AssessmentID`, `AcademicID`, `Assessment`, `TuitionFee`, `MiscFee`) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssdd', $assessmentID, $academicID, $assessment, $rmngTuition, $rmngMisc);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setOfficialDownpayment($academicID, $amountPaid, $paymentMode, $datePaid){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `downpayment`(`AcademicID`, `AmountPaid`, `PaymentMode`, `DatePaid`) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('sdss', $academicID, $amountPaid, $paymentMode, $datePaid);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setDownpaymentApproval($approvalID, $academicID, $paymentMode, $bank, $file, $status){
        $con = $this->connect();
        
        $mFile = uniqid() . $file['name'];
        if(move_uploaded_file($file['tmp_name'], "../user-uploads/" . $mFile)){
            $stmt = $con->prepare('INSERT INTO `downpayment_approval`(`ApprovalID`, `AcademicID`, `PaymentMode`, `Bank`, `File`, `Filename`, `Status`) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssss', $approvalID, $academicID, $paymentMode, $bank, $mFile, $file['name'], $status);
            $stmt->execute();
            $stmt->get_result();
            return $stmt->affected_rows;
        }
    }
    
    public function setStudentClass($classID, $studentID, $subjectID, $day, $time, $section, $adminID, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `student_class`(`ClassID`, `StudentID`, `SubjectID`, `Day`, `Time`, `Section`, `AdminID`, `SchoolYear`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssss', $classID, $studentID, $subjectID, $day, $time, $section, $adminID, $schoolYear);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setStudentAcademicInfo($academicID, $studentID, $courseID, $yearLevel, $semester, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `student_academic_info`(`AcademicID`, `StudentID`, `CourseID`, `YearLevel`, `Semester`, `SchoolYear`) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $academicID, $studentID, $courseID, $yearLevel, $semester, $schoolYear);
        $stmt->execute();

        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setStudentGrades($gradeID, $studentID, $subjectCode, $grade, $schoolYear, $status){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `student_grades`(`GradeID`, `StudentID`, `SubjectCode`, `Grade`, `SchoolYear`, `Status`) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $gradeID, $studentID, $subjectCode, $grade, $schoolYear, $status);
        $stmt->execute();
        
        return $stmt->affected_rows;
    }

    public function setStudent($studentID, $fName, $mName, $lName, $gender, $email, $contact, $bday, $img){
        $con = $this->connect();

        $filename = uniqid() . "-" . $img['name'];

        if(move_uploaded_file($img['tmp_name'], "../user-uploads/$filename")){
            $stmt = $con->prepare("INSERT INTO `student`(`StudentID`, `Firstname`, `Middlename`, `Lastname`, `Gender`, `Email`, `ContactNo`, `Birthdate`, `Image`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $studentID, $fName, $mName, $lName, $gender, $email, $contact, $bday, $filename);
            $stmt->execute();
            $stmt->get_result();
            return $stmt->affected_rows;
        }
    }

    public function setAddress($studentID, $houseNo, $street, $brgy, $city, $province){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `address`(`StudentID`, `HouseNo`, `Street`, `Barangay`, `City`, `Province`) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $studentID, $houseNo, $street, $brgy, $city, $province);
        $stmt->execute();
        $stmt->get_result();

        return $stmt->affected_rows;
    }

    public function setContactPerson($studentID, $fName, $lName, $email, $contactNo){
        $con = $this->connect();
        
        $stmt = $con->prepare('INSERT INTO `contact_person`(`StudentID`, `Firstname`, `Lastname`, `Email`, `ContactNo`) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param("sssss", $studentID, $fName, $lName, $email, $contactNo);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function setAdmissionInfo($admissionID, $studentID, $entry, $prefCourse, $controlNo, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('INSERT INTO `admission_info`(`AdmissionID`, `StudentID`, `Entry`, `PreferredCourse`, `ControlNo`, `SchoolYear`) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("ssssss", $admissionID, $studentID, $entry, $prefCourse, $controlNo, $schoolYear);
        $stmt->execute();
        $stmt->get_result();

        return $stmt->affected_rows;
    }

    public function setStudentFiles($fileID, $studentID, $filename, $tmpFile){
        $con = $this->connect();

        $uniqueFilename = uniqid() . "-" . $filename;

        if(move_uploaded_file($tmpFile, "../user-uploads/$uniqueFilename")){
            $stmt = $con->prepare('INSERT INTO `student_files`(`FileID`, `AdmissionID`, `Filename`, `File`) VALUES (?, ?, ?, ?)');
            $stmt->bind_param("ssss", $fileID, $studentID, $filename, $uniqueFilename);
            $stmt->execute();
            $stmt->get_result();

            return $stmt->affected_rows;
        }
    }
}