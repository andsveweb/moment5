<?php


// Installationsfil
include("includes/config.php");

$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if($db->connect_errno > 0) {
    die("fel vid anslutning:" . $db->connect_error);

}
$sql = "DROP TABLE IF EXISTS students;";

$sql .= "CREATE TABLE students(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(64) NOT NULL,
    email VARCHAR(64) NOT NULL,
    progression VARCHAR(64),
    syllabus VARCHAR(64),
    created timestamp NOT NULL DEFAULT current_timestamp()
    );";


    // felmeddelande om tabel inte kunde skapas

    if($db->multi_query($sql)) {
        echo "tabell skapad";
    } else {
        echo "något gick fel:" . $db->error;
    }