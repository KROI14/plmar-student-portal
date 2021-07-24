<?php

class Select extends Connection{

    public function getReferencesBySubjectCode($subjectCode){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `subject_reference` WHERE SubjectCode = ?');
        $stmt->bind_param('s', $subjectCode);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdminFromClass($subjectID, $day, $time, $section, $schoolYear){
        $con = $this->connect();
        
        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID WHERE student_class.SubjectID = ? AND student_class.Day = ? AND student_class.Time = ? AND student_class.Section = ? AND student_class.SchoolYear = ?');
        $stmt->bind_param('sssss', $subjectID, $day, $time, $section, $schoolYear);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getToEncodeOldStudents($schoolYear, $enrollStatus){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `old_student_enrollment` INNER JOIN student ON student.StudentID = old_student_enrollment.StudentID WHERE SchoolYear = ? AND EnrollmentStatus = ? GROUP BY student.StudentID');
        $stmt->bind_param('ss', $schoolYear, $enrollStatus);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getOldStudentEnrollmentByStudentIDSChoolYear($studentID, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `old_student_enrollment` WHERE StudentID = ? AND SchoolYear = ? ORDER BY EncodeID DESC LIMIT 1');
        $stmt->bind_param('ss', $studentID, $schoolYear);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getAnnouncementByType($type, $dept){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `announcement` INNER JOIN admin ON admin.AdminID = announcement.AdminID WHERE Type = ? AND admin.Department RLIKE(?);');
        $stmt->bind_param('ss', $type, $dept);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAnnouncementByID($announceID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `announcement` INNER JOIN admin ON admin.AdminID = announcement.AdminID WHERE AnnounceID = ?');
        $stmt->bind_param('s', $announceID);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getAnnouncementByAdminID($adminID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `announcement` WHERE AdminID = ?');
        $stmt->bind_param('s', $adminID);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGradesBySubjectCodeSchoolYearSectionStatusAdmin($subjectCode, $schoolYear, $section, $status, $adminID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_grades` INNER JOIN subject_course ON subject_course.SubjectCode = student_grades.SubjectCode INNER JOIN student_class ON (student_class.StudentID = student_grades.StudentID AND subject_course.SubjectID = student_class.SubjectID) INNER JOIN student ON student.StudentID = student_grades.StudentID WHERE student_grades.SubjectCode = ? AND student_grades.SchoolYear = ? AND student_class.Section = ? AND student_grades.Status RLIKE(?) AND student_class.AdminID = ? GROUP BY student.StudentID');
        $stmt->bind_param('sssss', $subjectCode, $schoolYear, $section, $status, $adminID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getEncodingOfGradesSchedule($schoolYear, $semester){
        $con = $this->connect();
        
        $stmt = $con->prepare('SELECT * FROM `grades_encode_sched` WHERE SchoolYear = ? AND Semester = ? ORDER BY ScheduleID DESC LIMIT 1');
        $stmt->bind_param('ss', $schoolYear, $semester);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getCheckIfSubjectHasBeenSubmitted($subjectCode, $adminID, $section, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM student_class INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN student_grades ON (student_grades.StudentID = student_class.StudentID AND student_grades.SubjectCode = subject_course.SubjectCode AND student_grades.SchoolYear = student_class.SchoolYear) WHERE student_grades.SubjectCode = ? AND (student_grades.Status = "on process" OR student_grades.Status = "approved" OR student_grades.Status = "rejected") AND student_class.AdminID = ? AND student_class.Section = ? AND student_grades.SchoolYear = ?');
        $stmt->bind_param('ssss', $subjectCode, $adminID, $section, $schoolYear);
        $stmt->execute();

        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function getMasterList($subjectCode, $section, $schoolYear, $semester, $adminID, $courseID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT student_class.*, subject_course.*, student.*, admission_info.*, student_academic_info.YearLevel AS StudentYearLevel FROM `student_class` INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN student ON student.StudentID = student_class.StudentID INNER JOIN admission_info ON admission_info.StudentID = student.StudentID INNER JOIN student_academic_info ON student_academic_info.StudentID = student_class.StudentID AND student_class.SchoolYear = student_academic_info.SchoolYear INNER JOIN course ON course.Course = admission_info.PreferredCourse WHERE subject_course.SubjectCode = ? AND student_class.Section = ? AND student_class.SchoolYear = ? AND subject_course.Semester = ? AND student_class.AdminID = ? AND course.CourseID = ? GROUP BY student.StudentID');
        $stmt->bind_param('ssssss', $subjectCode, $section, $schoolYear, $semester, $adminID, $courseID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectScheduleInformation($subjectCode, $section, $adminID, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode WHERE subject.SubjectCode = ? AND Section = ? AND AdminID = ? AND SchoolYear = ? GROUP BY subject.SubjectCode, Section');
        $stmt->bind_param('ssss', $subjectCode, $section, $adminID, $schoolYear);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getFacultySchedule($adminID, $schoolYear, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON student_class.SubjectID = subject_course.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode INNER JOIN course ON course.CourseID = subject_course.CourseID WHERE AdminID = ? AND student_class.SchoolYear = ? AND subject_course.Semester = ? GROUP BY student_class.SubjectID, student_class.Section');
        $stmt->bind_param('sss', $adminID, $schoolYear, $semester);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getFacultyByDepartmentAndRole($dept, $role){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `admin` WHERE Department = ? AND Role RLIKE(?)');
        $stmt->bind_param('ss', $dept, $role);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectGradeByStudentIDAndSubjectCode($studentID, $subjectCode, $status){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_grades` WHERE StudentID = ? AND SubjectCode = ? AND Status = ? ORDER BY GradeID DESC LIMIT 1');
        $stmt->bind_param('sss', $studentID, $subjectCode, $status);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getSubjectCourseByCourse($courseID){
        $con = $this->connect();
        
        $stmt = $con->prepare('SELECT * FROM `subject_course` INNER JOIN subject on subject.SubjectCode = subject_course.SubjectCode WHERE CourseID = ?');
        $stmt->bind_param('s', $courseID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectCourseByCourseAndType($courseID, $type){
       $con = $this->connect();
       
       $stmt = $con->prepare('SELECT * FROM `subject_course` INNER JOIN subject on subject.SubjectCode = subject_course.SubjectCode WHERE CourseID = ? AND subject.Type = ?');
       $stmt->bind_param('ss', $courseID, $type);
       $stmt->execute();

       $res = $stmt->get_result();
       return $res->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAssessmentDuesByAcademicIDAndAssessment($academicID, $assessment){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `assessment_due` WHERE Assessment = ? AND AcademicID = ?');
        $stmt->bind_param('ss', $assessment, $academicID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getAssessmentDuesByAcademicID($academicID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `assessment_due` WHERE AcademicID = ?');
        $stmt->bind_param('s', $academicID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getOfficialDownpaymentByAcademicID($academicID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `downpayment` WHERE AcademicID = ?');
        $stmt->bind_param('s', $academicID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getDownpaymentApprovalByApprovalID($approvalID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `downpayment_approval` WHERE ApprovalID = ? ORDER BY ApprovalID DESC LIMIT 1');
        $stmt->bind_param('s', $approvalID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getListOfSection($schoolYear, $courseID, $yearLevel, $semester, $type){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode WHERE student_class.SchoolYear = ? AND subject_course.CourseID = ? AND subject_course.YearLevel = ? AND subject_course.Semester = ? AND subject.Type RLIKE(?) GROUP BY student_class.Section');
        $stmt->bind_param('sssss', $schoolYear, $courseID, $yearLevel, $semester, $type);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getDownpaymentApprovalDataForTable($status, $schoolYear, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `downpayment_approval` INNER JOIN student_academic_info ON student_academic_info.AcademicID = downpayment_approval.AcademicID INNER JOIN student ON student.StudentID = student_academic_info.StudentID WHERE Status RLIKE(?) AND SchoolYear RLIKE(?) AND Semester RLIKE(?)');
        $stmt->bind_param('sss', $status, $schoolYear, $semester);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    //GET CLASSESS
    public function getClassByCourseYearSemSectionSchoolYear($courseID, $yearLevel, $semester, $section, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode INNER JOIN admin ON admin.AdminID = student_class.AdminID WHERE subject_course.CourseID = ? AND subject_course.YearLevel = ? AND subject_course.Semester = ? AND student_class.Section = ? AND student_class.SchoolYear = ? GROUP BY student_class.SubjectID');
        $stmt->bind_param('sssss', $courseID, $yearLevel, $semester, $section, $schoolYear);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getMajorClassToAddInstructor($schoolYear, $courseID, $yearLevel, $semester, $section, $department){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM student_class INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode WHERE student_class.SchoolYear = ? AND subject_course.CourseID = ? AND subject_course.YearLevel = ? AND subject_course.Semester = ? AND student_class.Section = ? AND subject.Department = ? AND subject.Type = "major" GROUP BY subject.SubjectCode');
        $stmt->bind_param('ssssss', $schoolYear, $courseID, $yearLevel, $semester, $section, $department);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getMinorClassToAddInstructor($schoolYear, $yearLevel, $semester, $section, $courseID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM student_class INNER JOIN subject_course ON subject_course.SubjectID = student_class.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode WHERE student_class.SchoolYear = ? AND subject_course.YearLevel = ? AND subject_course.Semester = ? AND student_class.Section = ? AND subject.Type = "minor" AND subject_course.CourseID = ? GROUP BY subject.SubjectCode');
        $stmt->bind_param('sssss', $schoolYear, $yearLevel, $semester, $section, $courseID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentClassByStudentIDSchoolYearSemester($studentID, $schoolYear, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` INNER JOIN subject_course ON student_class.SubjectID = subject_course.SubjectID INNER JOIN subject ON subject.SubjectCode = subject_course.SubjectCode WHERE StudentID = ? AND SchoolYear = ? AND Semester = ?');
        $stmt->bind_param('sss', $studentID, $schoolYear, $semester);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumberOfStudentsInSectionSubject($subjectID, $section, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare("SELECT COUNT(*) FROM `student_class` WHERE SubjectID = ? AND Section = ? AND SchoolYear = ?");
        $stmt->bind_param('sss', $subjectID, $section, $schoolYear);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getSectionOfSubjectBySubjectIDAndSchoolYear($subjectID, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_class` WHERE SubjectID = ? AND SchoolYear = ? ORDER BY Section DESC LIMIT 1');
        $stmt->bind_param('ss', $subjectID, $schoolYear);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    //Para makuha yung grade ng last year
    public function getLastYearLevelGrades($studentID, $lastYearLevel, $semester, $courseID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_grades` INNER JOIN subject_course ON student_grades.SubjectCode = subject_course.SubjectCode WHERE StudentID = ? AND YearLevel = ? AND Semester = ? AND CourseID = ?');
        $stmt->bind_param('ssss', $studentID, $lastYearLevel, $semester, $courseID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getMiscellaneousByAcademicInfo($courseID, $yearLevel, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `class_miscellaneous` INNER JOIN miscellaneous ON miscellaneous.MiscID = class_miscellaneous.MiscID WHERE CourseID = ? AND YearLevel = ? AND Semester = ?');
        $stmt->bind_param('sss', $courseID, $yearLevel, $semester);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getStudentAcademicInformationByStudentID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_academic_info` WHERE StudentID = ? ORDER BY AcademicID DESC LIMIT 1');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getStudentAcademicInfoByStudentAndSchoolYear($studentID, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_academic_info` WHERE StudentID = ? AND SchoolYear = ? ORDER BY AcademicID DESC LIMIT 1');
        $stmt->bind_param('ss', $studentID, $schoolYear);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getStudentAcademicInfoByAcademicInfo($studentID, $courseID, $yearLevel, $semester, $schoolYear){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_academic_info` WHERE StudentID = ? AND CourseID = ? AND YearLevel = ? AND Semester = ? AND SchoolYear = ?');
        $stmt->bind_param('sssss', $studentID, $courseID, $yearLevel, $semester, $schoolYear);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    //Grades
    public function getStudentGradesByStudentIDSubjectCodeSchoolYear($studentID, $subjectCode, $schoolYear){
        $con = $this->connect();
        
        $stmt = $con->prepare('SELECT * FROM `student_grades` WHERE StudentID = ? AND SubjectCode = ? AND SchoolYear = ?');
        $stmt->bind_param('sss', $studentID, $subjectCode, $schoolYear);
        $stmt->execute();

        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function getStudentCreditedSubjectsStudentIDNotSchoolYearSemester($studentID, $schoolYear, $semester){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_grades` INNER JOIN subject_course ON subject_course.SubjectCode = student_grades.SubjectCode INNER JOIN grade_dictionary ON grade_dictionary.Grade = student_grades.Grade WHERE student_grades.StudentID = ? AND (student_grades.SchoolYear != ? OR subject_course.Semester != ?) GROUP BY student_grades.SubjectCode');
        $stmt->bind_param('sss', $studentID, $schoolYear, $semester);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getRemarksByGrade($grade){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `grade_dictionary` WHERE Grade = ?');
        $stmt->bind_param('s', $grade);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getGradeDictionary(){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `grade_dictionary` ORDER BY Grade DESC');
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectByAcademicInfo($courseID, $yearLevel, $semester){
        $con = $this->connect();

        $stmt = $con->prepare("SELECT * FROM `subject` INNER JOIN subject_course ON subject.SubjectCode = subject_course.SubjectCode WHERE CourseID = ? AND YearLevel = ? AND Semester = ?");
        $stmt->bind_param('sss', $courseID, $yearLevel, $semester);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubjectBySubjectCode($subjectCode){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `subject` WHERE SubjectCode = ?');
        $stmt->bind_param('s', $subjectCode);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getStudentFilesByID($admissionID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_files` WHERE AdmissionID = ?');
        $stmt->bind_param('s', $admissionID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getAdmissionInformationByID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `admission_info` WHERE StudentID = ? ORDER BY AdmissionID DESC LIMIT 1');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getContactPersonByID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `contact_person` WHERE StudentID = ?');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getAddressByID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `address` WHERE StudentID = ?');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getStudentByID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student` WHERE StudentID = ?');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }
    
    public function getAdminByID($adminID){
        $con = $this->connect();

        $stmt = $con->prepare("SELECT * FROM `admin` WHERE AdminID = ?");
        $stmt->bind_param('s', $adminID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getStudentByLogin($username, $password){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `student_account` WHERE Username = ? AND Password = ?');
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getAdminLogin($username, $password, $usertype){
        $con = $this->connect();
        
        $stmt = $con->prepare("SELECT * FROM `admin` WHERE Username = ? AND Password = ? AND Role = ?");
        $stmt->bind_param('sss', $username, $password, $usertype);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getAdmissionDataForTable($schoolYear, $enrollStatus, $admissionStatus, $year, $dept){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM admission_info INNER JOIN student ON student.StudentID = admission_info.StudentID INNER JOIN course ON course.Course = admission_info.PreferredCourse WHERE SchoolYear RLIKE(?) && EnrollStatus RLIKE(?) AND AdmissionStatus RLIKE(?) AND YEAR(CreatedAt) RLIKE(?) AND course.Department RLIKE(?)');
        $stmt->bind_param('sssss', $schoolYear, $enrollStatus, $admissionStatus, $year, $dept);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getAdmissionInfoForPDF($admissionID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT student.*, address.*, contact_person.Firstname AS confName, contact_person.Lastname AS conlName, contact_person.Email AS conEmail, contact_person.ContactNo AS conContactNo, admission_info.* FROM student INNER JOIN address ON student.StudentID = address.StudentID INNER JOIN contact_person ON contact_person.StudentID = student.StudentID INNER JOIN admission_info ON admission_info.StudentID = student.StudentID WHERE admission_info.AdmissionID = ?');
        $stmt->bind_param('s', $admissionID);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getCourseByDepartment($dept){
        $con = $this->connect();
        
        $stmt = $con->prepare('SELECT * FROM course WHERE Department = ?');
        $stmt->bind_param('s', $dept);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourseByCourse($course){
        $con = $this->connect();

        $stmt = $con->prepare("SELECT * FROM `course` WHERE Course = ?");
        $stmt->bind_param('s', $course);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getCourseByCourseID($courseID){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM course WHERE CourseID = ?');
        $stmt->bind_param('s', $courseID);
        $stmt->execute();
        
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function getCourses(){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `course` WHERE CourseID RLIKE("CO1")');
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getControl($control){
        $con = $this->connect();

        $stmt = $con->prepare('SELECT * FROM `enrollment_control` WHERE Control = ?');
        $stmt->bind_param('s', $control);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc()['Status'];
    }

    public function getIncrementedID($tableName, $columnName){
        $con = $this->connect();
        
        $stmt = $con->query("SELECT $columnName FROM $tableName ORDER BY $columnName DESC LIMIT 1");
        $id = $stmt->fetch_assoc();

        $id = $id[$columnName];

        $numbers = preg_replace('/[^0-9]/', '', $id);
        $letters = preg_replace('/[^a-zA-Z]/', '', $id);

        return $letters . "-" . sprintf('%04d', ++$numbers);
    }
}