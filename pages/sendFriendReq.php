<?php

  include('dbconnection.php');

  if(ISSET($_POST['from']))
  {
      $from = $_POST['from'];
      $to = $_POST['to'];
      $status= 'Requested';
      if($_POST['status'])
      {
        $status = $_POST['status'];
      }
      

    // $q = "select * from friends where from_num = '$from' and to_num = '$to' ";

    $q = "insert into friends(from_num,to_num,status) values('$from','$to','$status')";

                     if($res = mysqli_query($conn , $q))
                     {
                        echo 'OK';
                        http_response_code(200);
                     }
                     else{
                     echo 'Error \n Failed to Get Data';
                     http_response_code(500);
                    }

      mysqli_close($conn);
  }
  else
  {
    http_response_code(500);
  }

?>