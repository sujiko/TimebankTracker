<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
  header("Location: adminLogin.php");
}
// check there are no errors
// need post so script runs on submit only
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../../conf.php';
  $dbhost = $host;
  $dbuser = $user;
  $dbpass = $password;
  $db = $database;
  if($_FILES['csv']['error'] == UPLOAD_ERR_OK){
    //assign the file name to a var
    $name = $_FILES['csv']['name'];
    $className = explode('.',$_FILES['csv']['name']);
    $class = $className[0];
    //assign the file extention to a var
    $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
    //get the file type in a var
    $type = $_FILES['csv']['type'];
    //get get serverside name of file in a var
    $tmpName = $_FILES['csv']['tmp_name'];
    // check the file is a csv
    if($ext === 'csv'){
      $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);
      //check to make sure you can open the csv and assign it to a var
      if(($myfile = fopen($tmpName, 'r')) !== FALSE) {
        while(!feof($myfile)){
          $line=fgetcsv($myfile);
          $fixLastName = explode("\n",$lineArray[2]);
          //echo $fixLastName[0].strlen($fixLastName[0]);
          $lineArray[2] = $fixLastName[0];
          $sql = "select pid, firstname, lastname from students where pid='".$line[0]."' and firstname='".$line[1]."' and lastname='".$line[2]."' and class='".$class."'";
          $result = $conn->query($sql);
          if ($result->num_rows==0) {
            $sql = "insert into students values('".$conn->real_escape_string($line[0])."','".$conn->real_escape_string($line[1])."','".$conn->real_escape_string($line[2])."',ENCODE('".$conn->real_escape_string($line[0])."','".$crypt_str."'),'".$class."',0,3)";
            $result = $conn->query($sql);
            if (!$result) {
              die("Error executing query: ($conn->errno) $conn->error");
            }
          }else{
            echo '<p>student already in system</p>';
          }
        }
        fclose($myfile);
        //WE DID IT YA'LL
        //echo "THATS A CSV";
      }
      else{
        //something wasn't right with the csv
        echo "could not open";
      }
    }
    else{
      //thats not a csv mate
      echo "not a csv";
    }
  }
}
?>
<html>
  <meta charset="UTF-8">
  <link rel="stylesheet" href = "home.css">
  <title>upload page</title>
  <h1>Upload a .csv containing your students here.</h1>
<body>
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
      <a href="studentsUpload.php">Make Assignment</a>
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
</body>
  <div>
    <form method="POST" action="studentsUpload.php"
      enctype="multipart/form-data"> 
       csv file <input type="file" name="csv"><br>
      <input type="submit" value="Submit">
    </form>
  </div>
</html>
