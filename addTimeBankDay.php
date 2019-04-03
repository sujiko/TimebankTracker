<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $conn = new mysqli ($dbhost, $dbuser, $dbpass, $db);
  //$result = $conn->query($sql);
  $sql = "select days from students where pid='".$_POST['pid']."' and class='".$_POST['class']."'";
   $result = $conn->query($sql);
   if (!$result) {
      die("Error executing query: ($conn->errno) $conn->error");
   }
   else {
     $row = $result->fetch_assoc();
     $count = $row['days'];
     $count = $count+$_POST['days'];
     $sql = "update students set days ='".$count."' where pid='".$_POST['pid']."' and class='".$_POST['class']."'";
     $result = $conn->query($sql);

   }
}
?>
<html>
<head>
<link rel="stylesheet" href = "home.css">
<title>View Classes</title>
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
      <a href="studentsUpload.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Analysis</button>
    <div class="dropdown-content">
      <a href="averagePerAssignment.php">Average Per Assignment</a>
      <a href="studentsUpload.php">Remaining Per Class</a>
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
<p>All of the courses you are teaching this semester and the students in those courses will appear below</p>
<body>
<form method="POST" action="addTimeBankDay.php">
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
  echo "<table><caption><input type='radio' name='class' value='".$row['class']."'>".$row['class']."</caption><br>";
     echo "<tr><th>PID</th><th>First Name</th><th>Last Name</th><th>Days Left</th></tr>";
     $newSql = "select pid, firstname, lastname, days from students where class='".$row['class']."' ";
     $newResult = $conn->query($newSql);
     while($curRow = $newResult->fetch_assoc()){
      echo "<tr><td>".$curRow['pid']."</td><td>".$curRow['firstname']."</td><td>".$curRow['lastname']."</td><td>".$curRow['days']."</td></tr>";
     }
     echo "</table><br>";
   }
?>
  <label>input student pid</label><input type="text" name='pid'required><br>
  <label>how many days to give</label><input type="number" min="0" name='days'required><br>
<input type="submit" value = "submit">
  
</body>
</html>

