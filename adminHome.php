<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
?>
<html>
<head>
<link rel="stylesheet" href = "home.css">
<title>Admin Homepage</title>
<meta charset = "utf-8">
</head>
<div class="navbar">
  <a href="adminHome.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Class</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Upload Class </a>
      <a href="adminViewClasses.php">View Classes</a>
      <a href="deleteAll.php">Delete All Classes</a>
      <a href="addTimeBankDay.php">Give A Timebank Day</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Assignment</button>
    <div class="dropdown-content">
      <a href="assignmentsUpload.php">Upload Assignments</a>
      <a href="makeAssignment.php">Make Assignment</a>
      <a href="adminViewAssignments.php">View Assignment</a>
      <a href="editAssignments.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Analysis</button>
    <div class="dropdown-content">
      <a href="averagePerAssignment.php">Average Per Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
      <a href="changePasswordAdmin.php">Change Password</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<h1> Admin Homepage </h1>
<body>

<p><font size = "5">Welcome to the Admin view </font></p>
<p><font size = "5">For tools on how to manage your classes, navigate to the Class tab </font></p>
<p><font size = "5">For tools on managing  your assignments, navigate to the Assignment tab  </font></p>
<p><font size = "5">For an overview on how time bank days are being used, navigate to the analysis tab </font></p>
<p><font size = "5">To change your password and sign out, navigate to the account tab</font></p>

</body>
</html>

