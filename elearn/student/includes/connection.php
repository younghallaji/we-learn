<?php

	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "elearn";

	$connect2db = new PDO("mysql:dbname=$dbname; host=$host", $username, $password);
	$connect2db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	// if($connect2db){
	// 	// echo 'connected';
	// } 
?>