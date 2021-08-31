<?php

  include('dbconnection.php');
  $number = $_POST['number'];
  $q = "SELECT name ,status, img, patient.number FROM friends inner join patient on patient.number = friends.to_num where friends.from_num = '$number' ";
//echo $q;
  if($res = mysqli_query($conn , $q))
  {  
      if(mysqli_num_rows($res) > 0)
      {
         $data = array();
      while( $rows = mysqli_fetch_assoc($res))
      {
         array_push($data , $rows);
      }
      echo json_encode($data) ;
      http_response_code(200);
     }
     else
     http_response_code(500);
  }
  else
  http_response_code(500);

?>