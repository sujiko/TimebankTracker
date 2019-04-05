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
      $brokenUp = explode('_',$className[0]);
      $className = $brokenUp[0]."_".$brokenUp[1];
      //check to make sure you can open the csv and assign it to a var
      $sql = "select class from assignments where class='".$className."'";
      $result = $conn->query($sql);
      $row = $result->num_rows;
      if(($myfile = fopen($tmpName, 'r')) !== FALSE && $row == 0) {
        while(!feof($myfile)){
          if (strcmp("Work",$brokenUp[2])!=0){
            $check = True;
            $msg = "the csv is not a work file";
            fclose($myfile);
            break;
          }
          $line=fgetcsv($myfile);
          if (count($line)!=2){
            $check = True;
            $msg = "the csv is not formatted properly";
            fclose($myfile);
            break;
          }
          $sql = "select pid from students where class='".$className."'"; 
          $result = $conn->query($sql);
          if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
              $newSql = "insert into assignments values('".$conn->real_escape_string($row['pid'])."','".$className."','".$line[0]."','".$line[1]."',0,'".$line[1]."')";
              $newResults = $conn->query($newSql);
              if (!$newResults){
                die("Error executing query: ($conn->errno) $conn->error");
              }else{
                $check =True;
                $msg = "all assignments uploaded";
              }
            }
          }else{
            echo "<p>please make sure the students are uploaded before the assignments</p>";
          }
        }
        fclose($myfile);
      }elseif($row > 0){
        $check = True;
        $msg = "this csv was already uploaded";
      }else{
        $check = True;
        $msg = "could not open the CSV";
      }
    }
    else{
      $check = True;
      $msg = "please make sure it is CSV";
    }
  }
}
?>
<html>
  <meta charset="UTF-8">
  <link rel="stylesheet" href = "home.css">
  <title>Assignment Upload</title>
<body>
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
      <a href="studentsUpload.php">Edit Assignment</a>
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
<?php 
if ($check){
  echo "<br>".$msg;
}  
?>
  <h1>Upload a .csv containing your assignments per class here</h1>
</body>
  <div>
    <form method="POST" action="assignmentsUpload.php"
      enctype="multipart/form-data"> 
       csv file <input type="file" name="csv"><br>
      <input type="submit" value="Submit">
    </form>
  </div>
</html>
