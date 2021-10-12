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
      
      $q = "insert into friends(from_num,to_num,status) values('$from', '$to','$status')";
     
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
else
{
   http_response_code(404);
}

?>