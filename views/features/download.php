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
         $file_name = $row['file_name'];
         $file_type = $row['file_type'];
         $file_size = $row['file_size'];
       }


       header("Cache-Control: maxage=1");
       header("Pragma: public");
       header("Content-type: $file_type");
       header("Content-Disposition: attachment; filename=$file_name");
       header("Content-Description: PHP Generated Data");
       header("Content-Transfer-Encoding: binary");
       header("Content-Length: $file_size");
      //  header('Accept-Ranges: bytes');
       ob_clean();
       flush();
      //  echo $file;
       readfile($file);
       mysqli_close($db);
       exit;


   } else { // 0 results are returned so there must be an error.
    //  header('Location: http://localhost/groupstart/views/features/logout.php'); // Error so log user out so they can try again.
    echo "No files";
   }



  //  list($id, $file, $file_name, $file_type, $file_size) = mysqli_fetch_array($result);
	// 			   //echo $id . $file . $type . $size;
	// 			   //echo 'sampath';
  //  header("Content-length: $size");
  //  header("Content-type: $type");
  //  header("Content-Disposition: attachment; filename=$name");
  //  ob_clean();
  //  flush();
  //  echo $file;
  //  mysqli_close($db);
  //  exit;
    // echo "trying";

	}













?>
