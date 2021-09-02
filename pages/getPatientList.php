<?php

  include('dbconnection.php');

  if(ISSET($_POST['num']))
  {
     
       $phone  = $_POST['num'];
  
          $q = "SELECT * from invitation where from_Doctor = '$phone' and status = 'Accept'" ;

                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                            $data = array();
                        while( $rows = mysqli_fetch_assoc($res))
                         {
                          $p =  $rows['to_Patient'];
                           $q = "SELECT name ,number, img from PATIENT where number = '$p' ";
                           $pres = mysqli_query($conn , $q);
                           $prows = mysqli_fetch_assoc($pres);
                            array_push($data , $prows);
                         }
                         echo json_encode($data) ;
                         http_response_code(200);
                        }
                        else
                        http_response_code(400);
                     }
                     else
                     http_response_code(404);

      mysqli_close($conn);
  }

?>