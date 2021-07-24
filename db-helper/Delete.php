<?php


class Delete extends Connection{
    
    public function dropAnnouncementByID($announceID){
        $con = $this->connect();

        $stmt = $con->prepare('DELETE FROM announcement WHERE AnnounceID = ?');
        $stmt->bind_param('s', $announceID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

    public function dropStudentByID($studentID){
        $con = $this->connect();

        $stmt = $con->prepare('DELETE FROM student WHERE StudentID = ?');
        $stmt->bind_param('s', $studentID);
        $stmt->execute();
        $stmt->get_result();
        return $stmt->affected_rows;
    }

}