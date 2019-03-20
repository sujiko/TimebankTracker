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
          $line=fgets($myfile);
          $lineArray = explode(',',$line);
          $fixLastName = explode('\\',$lineArray[2]);
          $lineArray[2] = $fixLastName[0];
          //echo $lineArray[2].strlen($lineArray[2]).'<br>';
          $sql = "insert into students values('".$conn->real_escape_string($lineArray[0])."','".$conn->real_escape_string($lineArray[1])."','".$conn->real_escape_string($lineArray[2])."',ENCODE('".$conn->real_escape_string($lineArray[0])."','".$crypt_str."'),'".$class."',0,3)";
          $result = $conn->query($sql);
          if (!$result) {
            die("Error executing query: ($conn->errno) $conn->error");
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
  <title>upload page</title>

    <form method="POST" action="csvUpload.php"
      enctype="multipart/form-data"> 
       csv file <input type="file" name="csv"><br>
      <input type="submit" value="Submit">
    </form>
    <form method="POST" action="logout.php">
     <input type="submit" value="logout">
    </form>

</html>
