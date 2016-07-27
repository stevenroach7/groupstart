<?php

  include '../../config/connection.php';




  if (isset($_GET['id'])) {
   $id = $_GET['id'];

   // switch statement to figure out what to query.
   $query = "SELECT * FROM attachments WHERE course_fk = '$id'";
   $result = mysqli_query($db, $query) or die('Error, query failed');


   if (mysqli_num_rows($result) === 1) {

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


   } elseif (mysqli_num_rows($result) > 1) {
     // Create zip file and let user download that.

     $zip_dir = '../../uploads/files.zip';
     $zip_name = 'files.zip';
     $zip = new ZipArchive;
     $zip->open($zip_dir, ZipArchive::CREATE);


     while($row = mysqli_fetch_assoc($result)) {

       $file_name = str_replace(',', '', $row['file_name']); // Need to remove commas from $file_name, http://stackoverflow.com/questions/13578428/duplicate-headers-received-from-server
       $target_dir = "../../uploads/";
       $target_file = $target_dir . basename($file_name);

       $zip->addFile($target_file);

     }


     $zip->close();

     header('Content-Type: application/zip');
     header('Content-disposition: attachment; filename='.$zip_name);
     header('Content-Length: ' . filesize($zip_dir));

     readfile("$zip_dir");


   } else { // 0 results are returned so there are no files to download
    echo "No files available to download";
   }

	}



?>
