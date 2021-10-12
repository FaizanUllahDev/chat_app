<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['getlist']))
  {
      
    $q = "SELECT status ,name , img, doctor.number FROM `doctorrequested` inner 
                     join doctor on doctor.number = doctorrequested.number";

                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res))
                         {
                            $data = array();
                         while( $rows = mysqli_fetch_assoc($res))
                         {
                            array_push($data , $rows);
                         }
                         echo json_encode($data) ;
                        }
                        else
                        echo 'NO Record';
                     }
                     else
                     echo 'Error \n Failed to Get Data';

      mysqli_close($conn);
  }
}
else
{
   http_response_code(404);
}

?>