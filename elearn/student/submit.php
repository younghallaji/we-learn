<?php
	include 'includes/connection.php';
	session_start();
	if (isset($_POST['questionid'])) {
		$uid = $_SESSION['id'];
		$question = $_POST['questionid'];
		$courseid = $_POST['courseid'];
		$answer = $_POST['answer'];


		$validateAnswer = $connect2db->prepare("SELECT answer FROM answers WHERE qid = ? AND options = ?");
		$validateAnswer->execute([$question, $answer]);
		$option = $validateAnswer->fetch();
		$output = $option->answer;
		// echo $output;

		$submitAnswer = $connect2db->prepare("SELECT * FROM results WHERE questionid = ? AND courseid = ? AND studentid = ?");
		$submitAnswer->execute([$question, $courseid, $uid]);
		if ($submitAnswer->rowcount() > 0) {
			$updResult = $connect2db->prepare("UPDATE results SET result = ?, answer = ? WHERE questionid = ? AND courseid = ? AND studentid = ?");
			$updResult->execute([$output, $answer, $question, $courseid, $uid]);
		} else {
			// Insert
			$insertResult = $connect2db->prepare("INSERT INTO results (questionid, courseid, studentid, result, answer) VALUES (?,?,?,?,?)");
			$insertResult->execute([$question,$courseid, $uid,$output,$answer]);
		}


	}

	if (isset($_POST['finishid'])) {
		session_start();
		$_SESSION['min']="";
		$_SESSION['sec']="";
		$uid = $_SESSION['id'];
		$question = $_POST['finishid'];
		$courseid = $_POST['courseid'];

		// $final = $connect2db->prepare("INSERT INTO results ()")

		$final = $connect2db->prepare("INSERT INTO results (questionid, courseid, studentid) VALUES (?,?,?)");
		$final->execute([$question, $courseid, $uid]);
		// $_SESSION['min'] = "";
		// $_SESSION['sec'] ="";
		// echo $question." ".$courseid;
	}
?>