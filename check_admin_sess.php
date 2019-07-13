<?php
session_start();

if(!isset($_SESSION['admin'])){
	header("Location: http://localhost/webscraper/adminlogin.php"); /* Redirect browser */
    exit();
}

?>