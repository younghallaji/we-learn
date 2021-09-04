<?php 
session_start();
session_destroy();

$msg= "Thanks For Using Our System See you soon";
echo  " <script>alert('$msg'); window.location='../index'</script>";

?>