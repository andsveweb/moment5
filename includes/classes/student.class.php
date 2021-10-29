<?php

class Student {
    private $db;
    private $fullname;
    private $mail;

    public function __construct() {

        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    // add student

    public function addStudent(string $fullname, string $email) :bool {
        $this->fullname = $fullname;
        $this->email = $email;

        $stmt = $this->db->prepare("INSERT INTO students (fullname, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->fullname, $this->email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
    public function getStudents() : array {
        $sql = "SELECT * FROM students ORDER BY fullname;";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteStudent(int $id) : bool {
        $id = intval($id);

        $sql = "DELETE FROM students WHERE id=$id;";
        $result = $this->db->query($sql);

        return $result;
    }

    public function getStudentById(int $id) : array {
        $id = intval($id);

        $sql = "SELECT * FROM students WHERE id=$id;";
        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStudent(int $id, string $fullname, string $email) : bool {
        $this->fullname = $fullname;
        $this->email = $email;
        $id = intval($id);

        $stmt = $this->db->prepare("UPDATE students SET fullname=?, email=? WHERE id=$id;");
        $stmt->bind_param("ss", $this->fullname, $this->email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}