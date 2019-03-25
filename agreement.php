<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: studentLogin.php");
}
?>
<html>
<head>
<link rel="stylesheet" href = "style.css">
<title>Terms of Service Agreement </title>
</head>
<body>
<h1> Terms of Service </h1>
<p lang="en"> Honor Code: Students are expected to conduct themselves in a manner consistent with the letter and spirit of the Honor Constitution. All assignments in this course fall under the conditions of the UMW Honor Code as well as the Computer Science Department Honor Code Policy. http://cs.umw.edu/mediawiki/index.php/CPSC_Department_Honor_Code_PolicyWriting
</p>
<form action = "#" onsubmit= "if(document.getElementByID('agree').chekced) { return true; } else alert('Please check that you have agreed to the Terms and Conditions'); return false; }">
<input type="checkbox" required name="checkbox" value="check" id="agree" /> I have read and agree to the Terms and Conditions
<form method="POST" action="studentView.php">
<input type="submit" name="Submit" value="submit" />
</form>
<?php
if ($_SERVER["REQUEST METHOD"] == "POST") {
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
}
?> 
<div>
<center>
<label>New Password: <input type="text" name="password"></label>
<?php

$conn = new mysqli ($dbhost, $dbuser, $dbpass, $db);
$result = $conn->query($sql);
?>
</center>
</div>
</body>
</html>

