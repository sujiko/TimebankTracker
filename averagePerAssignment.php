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
<title>View Assignments</title>
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
<p>The class title followed by the assignments and their initial due date will appear below</p>
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
  echo "<tr><th>Assignment Name</th><th>Initial Due Date</th><th>total used</th>";
  $newSql = "select distinct assignmentName, initDue from assignments where class='".$row['class']."' order by initDue ";
  $newResult = $conn->query($newSql);
  while($curRow = $newResult->fetch_assoc()){
    $countSql = "select SUM(daysUsed) from assignments where class='".$row['class']."' and assignmentName='".$curRow['assignmentName']."'";
    $totalSQL = "select SUM(daysUsed) from assignments where class'".$row['class']."'";
    $countRes = $conn->query($countSql);
    if (!$countRes) {
      die("Error executing query: ($conn->errno) $conn->error");
    }else{
      $countRow = $countRes->fetch_assoc();
    }
    $date = date_create($curRow['initDue']);
    $date = date_format($date,"m/d/Y");
    echo "<tr><td>".$curRow['assignmentName']."</td><td>".$date."</td><td>".$countRow['SUM(daysUsed)']."</td></tr>";
	
  }
  echo "</table><br>";
  $totalRes = $conn->query($totalSQL);
  $totRow = $totalRes->fetch_assoc()
	echo $totRow['SUM(daysUsed)'];

}
?>
</body>
</html>

