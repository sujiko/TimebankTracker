<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
?>
<html>
<head>
<link rel="stylesheet" href = "style.css">
<title> Timebank Tracker</title>
<meta charset = "utf-8">
</head>
<body>
<h1> Admin Homepage </h1>
<a href= "csvUpload.php">Upload a CSV </a>
</body>
<?php

?>
		
</html>

