<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['from']))
  {
      $from = $_POST['from'];
      $to = $_POST['tonum'];
      $status = $_POST['status'];
      $q= '';
      if($status != "UnFriend")
      $q = "update friends set status = '$status' where from_num = '$from' and to_num = '$to' ";
      else
      {
        $q = "delete from friends where from_num = '$from' and to_num = '$to'";
      }
      if($res = mysqli_query($conn , $q))
      {
       // echo $q;
        
       // echo json_encode($q);
         echo 'OK';
      }
      else
      echo 'Error';
  

      mysqli_close($conn);
  }
}

?>