<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["pid"])){ //if login in session is not set
  header("Location: studentLogin.php");
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
//	echo "you have selected: ".$_POST['assignment']."   ";
//	echo "you have used: ".$_POST['days']."     ";
//	echo "WELCOME: ".$_SESSION['username']."   ";
	$sqldays = 'UPDATE students SET days = (days - '.$_POST['days'].') WHERE pid = "'.$_SESSION['pid'].'"';
	if($conn->query($sqldays) == TRUE){
            echo "your assignment has been extended!";
        }else{
            echo "Error updating record: " . $conn->error;
        }
	$sqldays = 'UPDATE assignments SET daysUsed = (daysUsed + '.$_POST['days'].') WHERE pid= "'.$_SESSION['pid'].'" AND assignmentName = "'.$_POST['assignment'].'"';
	if($conn->query($sqldays) == TRUE){
	
	}else{
	     echo "Error updating days used: ".$CONN->error;
	}
	$initdays = 'SELECT newDueDate FROM assignments WHERE pid = "'.$_SESSION["pid"].'" AND assignmentName = "'.$_POST["assignment"].'"';	
	$getdate = $conn->query($initdays);
	$row = $getdate->fetch_assoc();
	$sqlDate = "UPDATE assignments SET newDueDate = DATE_ADD('".$row['newDueDate']."', INTERVAL ".$_POST['days']." DAY) WHERE assignmentName = '".$_POST['assignment']."' AND pid = '".$_SESSION['pid']."'";
	if ($conn->query($sqlDate) == TRUE) {
	    echo "date updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}

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
   $sql = "SELECT days FROM students WHERE pid ='".$_SESSION['pid']."' ";
   $result = $conn-> query($sql);
   $row = $result->fetch_assoc();
   echo "<p class='warning'> You have ".$row['days']." Timebank days to use. </p>";
   echo '<div>
    	<form method="POST" action="useTimebank.php"
    	enctype="multipart/form-data">';

   echo "<p>Choose an assignment: </p>";
   	 //echo "<table>";
    	//echo "<tr><th>Assignment Name </th><th>Due Date</th>";
   $newSql = "SELECT distinct assignmentName, initDue, newDueDate FROM assignments WHERE pid ='".$_SESSION['pid']."' ";
   $newResult = $conn->query($newSql);
   while($curRow = $newResult->fetch_assoc()){
	echo "<div style='display: inline-block; text-align: left;'>";
	echo "<input type='radio' name= 'assignment' value = '".$curRow['assignmentName']."' > ".$curRow["assignmentName"]."";
	$counter = (40 - strlen($curRow["assignmentName"]));
	for($counter; $counter > 0; $counter--){
		echo "&nbsp";
	}
	echo "".$curRow['newDueDate']."<br>";

	//if (i$assignment== $curRow["assignmentName"]);
	//"value = '".$curRow['assignmentName']."' > ".$curRow["assignmentName"]."";
     		//echo "<tr><td>".$curRow['assignmentName']."</td><td>".$curRow['initDue']."</td>";
   }
?>
       Number of Days to Use: <input type="number" min="0" name="days" required><br>
      <input type="submit" value="Submit">
    </form>
  </div>
</body>
