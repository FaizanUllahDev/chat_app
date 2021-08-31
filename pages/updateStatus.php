<?php

  include('dbconnection.php');

  if(ISSET($_POST['phone']))
  {
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    
      $q = "UPDATE doctorrequested SET status = '$status' where number = '$phone' ";
      if(mysqli_query($conn , $q))
      {
        echo 'update';
      }
      else
      echo 'Failed ...';

      mysqli_close($conn);
  }

?>