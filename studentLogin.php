<?php

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
   $sql = "SELECT pid, DECODE(password,'".$crypt_str."'),agreement FROM students WHERE pid='" . $conn->real_escape_string($username) . "'";
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
         session_start();
         $_SESSION["pid"] = $username;
         if ($row['agreement']== 0){
            header("Location: agreement.php");
         }else{
            header("Location: studentView.php");
         }
         die;
      } 
      else {
         echo "<p>Incorrect username or password.</p>";
      }
   }
}
?>
<html>
  <link href="home.css" type="text/css" rel="stylesheet"/>
   <title>Login</title>
  <div class="navbar">
    <a href="index.php">Home</a>
    <div class="dropdown">
      <button class="dropbtn">Login</button>
      <div class="dropdown-content">
        <a href= "adminLogin.php"> Admin Login </a>
        <a href= "studentLogin.php">Student Login </a>
      </div>
    </div>
  </div>
  <h1>Student Login</h1>
    <body>
    <form id="log" method="post" action="studentLogin.php">
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


