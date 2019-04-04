<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["pid"])){ //if login in session is not set
  header("Location: studentLogin.php");
}
?>
<html>
<div class="navbar">
  <a href="studentView.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Timebank Days</button>
    <div class="dropdown-content">
      <a href="useTimebank.php">Use a Timebank Day</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Assignment</button>
    <div class="dropdown-content">
      <a href="studentViewAssignments.php">View Assignments</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
      <a href="changePassword.php">Change Password</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<head>
<link rel="stylesheet" href = "home.css">
<title>Student Portal</title>
<meta charset = "utf-8">
<h1> Student Homepage </h1>
</head>
<body>
<?php
   include '../../conf.php';
   $dbhost = $host;
   $dbuser = $user;
   $dbpass = $password;
   $db = $database;
   $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
    $sql = "SELECT days FROM students WHERE pid ='".$_SESSION['pid']."' ";
    $result = $conn-> query($sql);
    $row = $result->fetch_assoc();
  echo "<p class = 'warning'> YOU HAVE ".$row['days']." TIMEBANK DAYS LEFT! </p>";
        $sqlClass = "SELECT class FROM students WHERE pid = '".$_SESSION['pid']."'";
        $resultClass = $conn->query($sqlClass);
 	while($classRow = $resultClass->fetch_assoc()){
        echo "<p style= 'text-align:center;' > class: ".$classRow['class']."</p>";
    echo "<table>";
    echo "<tr><th>Assignment Name </th><th>Due Date</th><th>Your Due Date</th>";
     $newSql = "SELECT assignmentName, initDue, newDueDate FROM assignments WHERE pid ='".$_SESSION['pid']."' AND class='".$classRow['class']."'";
     $newResult = $conn->query($newSql);
     while($curRow = $newResult->fetch_assoc()){
      echo "<tr><td>".$curRow['assignmentName']."</td><td>".$curRow['initDue']."</td><td>".$curRow['newDueDate']."</td>";
        }
      echo "</table><br>";
      }
?>

</body>


