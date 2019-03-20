<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
    header("Location: adminLogin.php");
}
// check there are no errors
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv
    if($ext === 'csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
           echo "THATS A CSV";
	}
	else{
	   echo "could not open";
	}
    }
    else{
    echo "not a csv";
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
