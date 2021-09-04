<?php 
session_start();
include '../../includes/connection.php';
$uid = $_SESSION['id'];
	if (isset($_POST['message'])) {
		$course_code = $_POST['course_code'];
        $messsage = $_POST['message'];

        $insert = $connect2db->prepare("INSERT INTO chatroom (sender, message, class_code)VALUES(?,?,?)");
        $insert->execute([$uid, $messsage, $course_code]);
       
	}
?>