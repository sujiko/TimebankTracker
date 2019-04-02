<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
  echo "in post";
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $conn = new mysqli ($dbhost, $dbuser, $dbpass, $db);
  //$result = $conn->query($sql);
  $sql = "UPDATE students set agreement='1',password=ENCODE('".$_POST['password']."','".$crypt_str."')where pid='".$_SESSION["username"]."'";
  echo $sql;
   $result = $conn->query($sql);
   if (!$result) {
      die("Error executing query: ($conn->errno) $conn->error");
   }
   else {
         header("Location: studentView.php");
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
      <a href="changePassword.php">Change Password</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>

<h1>Change your password</h1>
<form method="POST" action="changePassword.php">
New Password: <input type="text" name="password" required>
<input type="submit" value = "submit">
</form>
</body>
</html>
