<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
  echo "Incorrect old password";
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $conn = new mysqli ($dbhost, $dbuser, $dbpass, $db);
  $userpassword = $_POST["oldpassword"];

  //$result = $conn->query($sql);
  $sql = "SELECT username, DECODE(password,'".$crypt_str."') FROM admin WHERE username='" .$_SESSION["username"] . "'";
   $result = $conn->query($sql);
   if (!$result) {
      die("Error executing query: ($conn->errno) $conn->error");
   }
   elseif ($result->num_rows == 0) {
      echo "<p>Incorrect username or password.</p>";
   }
   else {
      $row = $result->fetch_assoc();
      // See if submitted password matches the hash stored in the Users table    
      if (strcmp($userpassword, $row["DECODE(password,'".$crypt_str."')"]) == 0) {
 
  $sql = "UPDATE admin set password=ENCODE('".$_POST['password']."','".$crypt_str."')where username='".$_SESSION["username"]."'";
   $result = $conn->query($sql);
   if (!$result) {
      die("Error executing query: ($conn->errno) $conn->error");
   }
   else {
         header("Location: adminHome.php");
   }
}
}
}
?>
<html>
<head>
<link rel ="stylesheet" href= "home.css">
<meta charset = "utf-8">
<title>Password change</title>
</head>
<body>
<div class="navbar">
  <a href="adminHome.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Class</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Upload Class </a>
      <a href="adminViewClasses.php">View Classes</a>
      <a href="deleteAll.php">Delete All Classes</a>
      <a href="addTimeBAnkDay.php">Give A Timebank Day</a>
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

<h1>Change your password</h1>
<form method="POST" action="changePasswordAdmin.php">
Old Password: <input type="password" name = "oldpassword" required>
New Password: <input type="password" name="password" required>
<input type="submit" value = "submit">
</form>
</body>
</html>

