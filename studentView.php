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
    echo "<table>";
    echo "<tr><th>Assignment Name </th><th>Due Date</th>";
     $newSql = "SELECT distinct assignmentName, initDue, newDueDate FROM assignments WHERE pid ='".$_SESSION['pid']."' ";
     $newResult = $conn->query($newSql);
     while($curRow = $newResult->fetch_assoc()){
       // echo "<input type='radio name= 'assignment'"
       // if (isset($assignment) && $assignment== $curRow["assignmentName"]) echo "checked";
       // echo "value = '".$curRow['assignmentName']."' > ".$curRow["assignmentName"]."";
      echo "<tr><td>".$curRow['assignmentName']."</td><td>".$curRow['initDue']."</td>";
        }
      echo "</table><br>";
?>

</body>


