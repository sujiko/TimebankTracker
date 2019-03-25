<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: studentLogin.php");
}
?>
<html>
<head>
<link rel="stylesheet" href = "home.css">
<title>Student Portal</title>
<meta charset = "utf-8">
</head>
<h1> Student Homepage </h1>
<div class="navbar">
  <a href="adminHome.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Timebank Days</button>
    <div class="dropdown-content">
      <a href="">Use a Timebank Day</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Assignment</button>
    <div class="dropdown-content">
      <a href="">View Assignments</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
      <a href="">Settings</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<body>
</body>


