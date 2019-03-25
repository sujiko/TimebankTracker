<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
// If POST then check submitted username and password
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
   $sql = "SELECT username, DECODE(password,'".$crypt_str."') FROM admin WHERE username='" . $conn->real_escape_string($username) . "'";
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
        $sql = "Delete from students";
        $result = $conn->query($sql);
        if (!$result) {
          die("Error executing query: ($conn->errno) $conn->error");
        }else{
          $sql = "Delete from assignments";
          $result = $conn->query($sql);
          if (!$result) {
            die("Error executing query: ($conn->errno) $conn->error");
          } else{
            echo "you have deleted all from the table";
          }
        }
      } 
      else {
         echo "<p>Incorrect username or password.</p>";
      }
   }
}
?>
<!DOCTYPE html>
<html>
  <link rel="stylesheet" href="home.css" type="text/css"/>
   <title>Delete All</title>
<div class="navbar">
  <a href="adminHome.php">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Class</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Upload Class </a>
      <a href="adminViewClasses.php">View Classes</a>
      <a href="deleteAll.php">Delete All Classes</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Assignment</button>
    <div class="dropdown-content">
      <a href="assignmentsUpload.php">Upload Assignments</a>
      <a href="makeAssignment.php">Make Assignment</a>
      <a href="studentsUpload.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Analysis</button>
    <div class="dropdown-content">
      <a href="assignmentsUpload.php">Average Per Assignment</a>
      <a href="studentsUpload.php">Remaining Per Class</a>
      <a href="studentsUpload.php">Edit Assignment</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
      <a href="studentsUpload.php">Settings</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
  <p>IN ORDER TO DELETE ALL CLASSES AND ASSIGNMENTS PLEASE ENTER YOUR USERNAME AND PASSWORD</p>
    <body>
    <form id="log" method="post" action="deleteAll.php">
      <div>
    <center>
        <label>Username: <input type="text" name="username" autofocus></label>
        </center>
      </div>
      <div>
        <center>
        <label>Password: <input type="password" name="password"></label>
        </center>
      </div>
      <input type="submit" value="Login">
    </form>
  </body>
</html>
