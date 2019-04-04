<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["pid"])){ //if login in session is not set
  header("Location: studentLogin.php");
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
<link rel="stylesheet" href="style.css">
<meta charset = "utf-8">
<title>Terms of Service Agreement </title>
</head>
<body>
<h1> Terms of Service </h1>
<p > Honor Code: Students are expected to conduct themselves in a manner consistent with the letter and spirit of the Honor Constitution. All assignments in this course fall under the conditions of the UMW Honor Code as well as the Computer Science Department Honor Code Policy. 
</p>
<a href="http://cs.umw.edu/mediawiki/index.php/CPSC_Department_Honor_Code_Policy">UMW CPSC Honor Code Policy</a>
<form method="POST" action="agreement.php">
<input type="checkbox" required name="checkbox" value="check"> I have read and agree to the Terms and Conditions<br>
New Password: <input type="text" name="password" required>
<input type="submit" value="submit" >
</form>
</body>
</html>

