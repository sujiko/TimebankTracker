<!DOCTYPE html>
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

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $upload_dir = "";
   if ($_FILES["csv"]["error"] == UPLOAD_ERR_OK) {
      $tmp_name = $_FILES["csv"]["tmp_name"];
        
      // Ignore any path information in the filename
      $name = basename($_FILES["csv"]["name"]);
        
      // Move the temp file and give it a new name 
      echo "<p>uploaded file'$name'</p>";
	
   }
   else {
      echo "<p>Error uploading the .csv file</p>";
   }
}
?>
</html>
