<?php

  include('dbconnection.php');

  if(ISSET($_POST['phone']))
  {
    $phone = $_POST['phone'];
    
      $q = "select status from doctorrequested where number = '$phone' ";
      if($res = mysqli_query($conn , $q))
      {
        if($rows = mysqli_fetch_assoc($res))
             echo json_encode($rows);
      }
      else
      echo 'Failed ...';
      //echo $q;

      mysqli_close($conn);
  }

?>