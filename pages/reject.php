<?php

  include('dbconnection.php');

  if(ISSET($_POST['from']))
  {
      $from = $_POST['from'];
      $to = $_POST['tonum'];
      $status = $_POST['status'];
      
      $q = "DELETE FROM friends where from_num = '$from' and to_num = '$to'";
       print($q);
      $res = mysqli_query($conn , $q);
      if($res)
      { 
         echo 'OK';
         http_response_code(200);
      }
      else
      {
      echo 'Error';
      
      http_response_code(400);
  }

      mysqli_close($conn);
  }

?>