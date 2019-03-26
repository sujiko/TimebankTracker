<!DOCTYPE htmlmakeAssignment>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
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
      <a href="assignmentsUpload.php">Average Per Assignment</a>
      <a href="studentsUpload.php">Remaining Per Class</a>
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
<div>
<h2>Please select which class you would like to make an assignment for</h2>
   <form method="POST" action="makeAssignment.php">
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
   echo "<ul>";
   while($row = $result->fetch_assoc()){
     echo "<input type='checkbox' name='class' value='".$row['class']."'>".$row['class']."<br>";
   }
   echo "</ul>";
?>
  Assignment name<br><input type="text" name="assignmentDate"><br><br>
  initial due date<br><input type="text"name-"initDue" ><br><br>
<input type="submit" value="submit">
</form>
</div>
</html>
