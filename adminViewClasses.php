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
<h1> Admin Homepage </h1>
<div class="navbar">
  <a href="adminHome.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Class</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Upload Class </a>
      <a href="adminViewClasses.php">View Classes</a>
      <a href="studentsUpload.php">Delete All Classes</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Assignment</button>
    <div class="dropdown-content">
      <a href="assignmentsUpload.php">Upload Assignments</a>
      <a href="studentsUpload.php">Make Assignment</a>
      <a href="studentsUpload.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Analysis</button>
    <div class="dropdown-content">
      <a href="assignmentsUpload.php">Average Per Assignment</a>
      <a href="studentsUpload.php">Remaining Per Class</a>
      <a href="studentsUpload.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Settings</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<body>
<?php
   include '../../conf.php';
   $dbhost = $host;
   $dbuser = $user;
   $dbpass = $password;
   $db = $database;
   // Get values submitted from the form
   $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
   $sql = "select distinct class from students";
   $result = $conn->query($sql);
   while($row = $result->fetch_assoc()){
     echo "<table><caption>".$row['class']."</caption>";
     echo "<tr><th>PID</th><th>First Name</th><th>Last Name</th><th>Days Left</th></tr>";
     $newSql = "select pid, firstname, lastname, days from students where class='".$row['class']."' ";
     $newResult = $conn->query($newSql);
     while($curRow = $newResult->fetch_assoc()){
      echo "<tr><td>".$curRow['pid']."</td><td>".$curRow['firstname']."</td><td>".$curRow['lastname']."</td><td>".$curRow['days']."</td></tr>";
     }
     echo "</table><br>";
   }
?>
</body>
</html>

