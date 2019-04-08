<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $className = $_POST['class'];    
  $assignment= $_POST['assignmentName'];    
  $dueDate = $_POST['initDue'];    
  $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
  $sql = "select class,assignmentName,initDue from assignments where class='".$className."' and assignmentName ='".$assignment."'and initDue='".$dueDate."'";
  $result = $conn->query($sql);
  if ($result->num_rows==0){ 
    $sql = "select pid from students where class='".$className."'"; 
    $result = $conn->query($sql);
    if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        $newSql = "insert into assignments values('".$conn->real_escape_string($row['pid'])."','".$className."','".$assignment."','".$dueDate."',0,'".$dueDate."')";
        $newResults = $conn->query($newSql);
        if (!$newResults){
          die("Error executing query: ($conn->errno) $conn->error");
        }
      }
      echo "<p>assignment ".$assignment." added for class ".$className."</p>";
    }else{
      echo "<p>please make sure the students are uploaded before the assignments</p>";
    }
  }else{
     echo "<p>that assignment already exists for that class</p>";
  }
}
?>
<html>
<head>
<link rel="stylesheet" href = "home.css">
<title>Make An Assignment</title>
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
  echo "<input type='radio' name='class' value='".$row['class']."'>".$row['class']."<br>";
}
echo "</ul>";
?>
  Assignment name<br><input type="text" name="assignmentName" required><br><br>
  initial due date<br><input type="date"name="initDue" required><br><br>
<input type="submit" value="submit">
</form>
</div>
</html>

