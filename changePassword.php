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
         header("Location: index.php");
   }
}
?>
<html>
<head>
<link rel ="stylesheet" href= "style.css">
<meta charset = "utf-8">
<title>Password change</title>
</head>
<body>
<h1>Change your password</h1>
<form method="POST" action="changePassword.php">
New Password: <input type="text" name="password" required>
<input type="submit" value = "submit">
</form>
</body>
</html>

