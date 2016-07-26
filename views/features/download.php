<?php

  // script to display BLOB from MySQL db. Should work for all attachments as id is passed through url
  include '../../config/connection.php';



  if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $query = "SELECT * FROM attachments WHERE course_fk = '$id'";
   $result = mysqli_query($db, $query) or die('Error, query failed');


   if (mysqli_num_rows($result) > 0) {

      while($row = mysqli_fetch_assoc($result)) {
        $id = $row['attachment_id'];
        $file = $row['file'];
        $file_name = str_replace(',', '', $row['file_name']); // Need to remove commas from $file_name, http://stackoverflow.com/questions/13578428/duplicate-headers-received-from-server
        $file_type = $row['file_type'];
        $file_size = $row['file_size'];
      }

       header("Content-length: $file_size");
	     header("Content-type: $file_type");
	     header("Content-Disposition: attachment; filename=$file_name");
	     ob_clean();
	     flush();
	     echo $file;
	     mysqli_close($db);
	     exit;
      //  header('Location: http://localhost/groupstart/views/instructor-courses.php');



   } else { // 0 results are returned so there are no files to download
    echo "No files available to download";
    exit;
   }

	}



?>
