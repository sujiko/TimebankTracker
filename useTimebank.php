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
	$assignmentclass = explode(',',$_POST['assignment']);
	$assignment = $assignmentclass[0];
	$class = $assignmentclass[1];
	$sqlHowMany = "SELECT days FROM students WHERE pid ='".$_SESSION['pid']."'";
	$DaysLeft = $conn->query($sqlHowMany);
	$dayRow = $DaysLeft->fetch_assoc();
	$daysLeft = $dayRow['days'];
	$updated = FALSE;
	$notValid = TRUE;
	if($daysLeft >= $_POST['days']){
	$sqldays = 'UPDATE students SET days = (days - '.$_POST['days'].') WHERE pid = "'.$_SESSION['pid'].'" AND class= "'.$class.'"';
	if($conn->query($sqldays) == TRUE){
	}else{
		$notValid = TRUE;
		$updated = FALSE;
		echo "Error updating student numdays: " . $conn->error;
	}
	$sqldays = 'UPDATE assignments SET daysUsed = (daysUsed + '.$_POST['days'].') WHERE pid= "'.$_SESSION['pid'].'" AND assignmentName = "'.$assignment.'" AND class= "'.$class.'"';
	if($conn->query($sqldays) == TRUE){
		
	}else{
		$updated = TRUE;
		$notValid = FALSE;
		echo "Error updating days used: ".$CONN->error;
	}
	$initdays = 'SELECT newDueDate FROM assignments WHERE pid = "'.$_SESSION["pid"].'" AND assignmentName = "'.$assignment.'" AND class= "'.$class.'"';	
	$getdate = $conn->query($initdays);
	$row = $getdate->fetch_assoc();
	$sqlDate = "UPDATE assignments SET newDueDate = DATE_ADD('".$row['newDueDate']."', INTERVAL ".$_POST['days']." DAY) WHERE assignmentName = '".$assignment."' AND pid = '".$_SESSION['pid']."' AND class= '".$class."'";
	if ($conn->query($sqlDate) == TRUE) {
	} else {
		$notValid = TRUE;
		$updated = FALSE;
		echo "Error updating date: " . $conn->error;
	}
	}else{
 	$updated = FALSE;	
	$notValid = TRUE;
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
			if($updated == TRUE){
				echo "<p class='goal'> Due Date Updated </p>";
			}
			$updated = FALSE;
			if($notValid == TRUE){
				echo "<p class= 'valid'> That is not a valid timebank entry </p>";
			}
			$notValid = FALSE;	
			echo "<p class='warning'> You have ".$row['days']." Timebank days to use. </p>";
			echo '<div> <form method="POST" action="useTimebank.php" enctype="multipart/form-data">';
			echo "<p>Choose an assignment: </p>";
			$sqlClass = "SELECT class FROM students WHERE pid = '".$_SESSION['pid']."'";
			$resultClass = $conn->query($sqlClass);
			echo "<div style='display: inline-block; text-align: left;'>";
			while($classRow = $resultClass->fetch_assoc()){
				echo "<p> class: ".$classRow['class']."</p>";
				$newSql = "SELECT assignmentName, initDue, newDueDate FROM assignments WHERE pid ='".$_SESSION['pid']."' AND class = '".$classRow['class']."' " ;
				$newResult = $conn->query($newSql);
				echo "<div>";
				while($curRow = $newResult->fetch_assoc()){
					echo "<input type='radio' name= 'assignment' value = '".$curRow['assignmentName'].",".$classRow['class']."' > ".$curRow["assignmentName"]."";
					$counter = (40 - strlen($curRow["assignmentName"]));
					for($counter; $counter > 0; $counter--){
						echo "&nbsp";
					}
					echo "".$curRow['newDueDate']."<br>";
				}
				echo "</div>";
			}
		?>
		Number of Days to Use: <input type="number" min="0" name="days" required><br>
		<input type="submit" value="Submit">
		</form>
		</div>
	</body>
</html>
