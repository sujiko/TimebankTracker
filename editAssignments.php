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
   // Get values submitted from the form
   $username = $_POST["username"];
   $userpassword = $_POST["password"];
  // Get user's hashed password from the Users table
   $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
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
    <form id="log" method="post" action="editAssignments.php">
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
     echo "<tr><th>Assignment Name</th><th>Initial Due Date</th>";
     $newSql = "select distinct assignmentName, initDue from assignments where class='".$row['class']."' ";
     $newResult = $conn->query($newSql);
     while($curRow = $newResult->fetch_assoc()){
       $date = date_create($curRow['initDue']);
       echo "<tr><td><input type='radio' name='assignmentName' value='".$row['class']." ".$curRow['assignmentName']."'>";
       echo $curRow['assignmentName']."</td><td>".date_format($date,"m/d/Y")."</td></tr>";
     }
     echo "</table><br>";
   }
?>
      <select name="doing">
        <option>update</option>
        <option>delete</option>
      </select>
      <input type="submit" value="submit">
</form>
</body>
</html>

