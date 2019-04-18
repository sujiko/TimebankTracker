<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["pid"])){ //if login in session is not set
  header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
  echo  "Incorrect old password";
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  $conn = new mysqli ($dbhost, $dbuser, $dbpass, $db);
  //$result = $conn->query($sql); 
   $userpassword = $_POST["oldpassword"];

  //$result = $conn->query($sql);
  $sql = "SELECT pid, DECODE(password,'".$crypt_str."') FROM students WHERE pid='" .$_SESSION["pid"] . "'";
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
 
  $sql = "UPDATE students set password=ENCODE('".$_POST['password']."','".$crypt_str."')where pid='".$_SESSION["pid"]."'";
  echo $sql;
   $result = $conn->query($sql);
   if (!$result) {
      die("Error executing query: ($conn->errno) $conn->error");
   }
   else {
         header("Location: studentView.php");
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

<h1>Change your password</h1>
<form method="POST" action="changePassword.php">
Old Password: <input type="password" name = "oldpassword" required>
New Password: <input type="password" name="password" required>
<input type="submit" value = "submit">
</form>
</body>
</html>

