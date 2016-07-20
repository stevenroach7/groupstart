<?php

  if (session_status() == PHP_SESSION_NONE) { // Start session if it has not been started already so we have access to session storage.
    session_start();
  }


  // Query DB here
  $email = $_SESSION['email'];

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://groupstartstudents.auth0.com/dbconnections/change_password",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"client_id\": \"KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm\",\"email\": \"$email\", \"connection\": \"Username-Password-Authentication\"}",
    CURLOPT_HTTPHEADER => array(
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
    echo " If you are signed on through Google or Facebook, use those services to change your password.";
  }




  echo " This page will redirect in 5 seconds.";
  header('Refresh: 5; URL= http://localhost/groupstart/views/student-settings.php');
?>
