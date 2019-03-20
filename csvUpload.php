<?php
session_start();
if(!isset($_SESSION["username"])){ //if login in session is not set
    header("Location: adminLogin.php");
}
echo $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $upload_dir = "";
   if ($_FILES["csv"]["error"] == UPLOAD_ERR_OK) {
      $tmp_name = $_FILES["csv"]["tmp_name"];
        
      // Ignore any path information in the filename
      $name = basename($_FILES["csv"]["name"]);
	//stores the full file name/path with extention
      $info = pathinfo($_FILES['uploadedfile']['name']);
	//checks to see if the extension is a csv
      if($info['extension'] == 'csv'){  
	// display that the file is uploaded 
      echo "<p>uploaded file'$name'</p>";
      }
      else{
	// display that it is not a csv file
	echo "thats not a CSV file";
      }
	
   }
   else {
	// display an error for uploading
      echo "<p>Error uploading the .csv file</p>";
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
