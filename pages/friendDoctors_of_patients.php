<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['number']))
  {
       $number = $_POST['number'];
      $role = $_POST['role'];
    
      if(true)
      {
            $q = "SELECT name , status, friends.from_num, img, doctor.number FROM friends inner join doctor on doctor.number = friends.from_num where friends.to_num = '$number' ";

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
      }
      else {
         $q = "SELECT name ,status, img, patient.number FROM friends inner 
         join patient on patient.number = friends.from_num where friends.to_num = '$number' ";

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
      }

      mysqli_close($conn);
  }
}
else
{
   http_response_code(404);
}
?>