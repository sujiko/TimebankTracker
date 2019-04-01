<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
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
      <a href="studentSettings.php">Settings</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<head>
<link rel="stylesheet" href = "home.css">
<title>Timebank Use</title>
<meta charset = "utf-8">
<h1> Use a Timebank Day </h1>
</head>
<body>
<?php
   include '../../conf.php';
   $dbhost = $host;
   $dbuser = $user;
   $dbpass = $password;
   $db = $database;
   $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
   $sql = "SELECT days FROM students WHERE pid ='".$_SESSION['username']."' ";
   $result = $conn-> query($sql);
   $row = $result->fetch_assoc();
   echo "<p.warning> You have ".$row['days']." Timebank days to use. </p>";
   echo "<p>Choose an assignment: </p>";
   	 //echo "<table>";
    	//echo "<tr><th>Assignment Name </th><th>Due Date</th>";
   $newSql = "SELECT distinct assignmentName, initDue, newDueDate FROM assignments WHERE pid ='".$_SESSION['username']."' ";
   $newResult = $conn->query($newSql);
   while($curRow = $newResult->fetch_assoc()){
	echo "<div style='display: inline-block; text-align: left;'>";
	echo "<input type='radio' name= 'assignment' value = '".$curRow['assignmentName']."' > ".$curRow["assignmentName"]."<br>";

	//if (i$assignment== $curRow["assignmentName"]);
	//"value = '".$curRow['assignmentName']."' > ".$curRow["assignmentName"]."";
     		//echo "<tr><td>".$curRow['assignmentName']."</td><td>".$curRow['initDue']."</td>";
   }
	
     	//echo "</table><br>";
?>
</body>
