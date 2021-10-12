<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['phone']))
  {
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    
      $q = "UPDATE patient SET isCcdAllow = '$status' where number = '$phone' ";
      if(mysqli_query($conn , $q))
      {
        echo 'update';
        http_response_code(200);
      }
      else
      {
      echo 'Failed ...';
      http_response_code(400);
      }

      mysqli_close($conn);
  }
}

?>