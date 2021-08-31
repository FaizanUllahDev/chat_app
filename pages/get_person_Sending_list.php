<?php

  include('dbconnection.php');

  if(ISSET($_POST['number']))
  {
       $number = $_POST['number'];
      $role = $_POST['role'];
      if(true)
      {
            $q = "SELECT name , status, img,  doctor.number FROM friends inner 
                     join doctor on doctor.number = friends.to_num where friends.from_num = '$number' and  STATUS != 'Cancel' ";

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
                        }
                        else
                        {
                        echo 'Error No Recored';
                       // echo $q;
                        }
                     }
                     else
                     echo 'Error';
      }
      else {
         $q = "SELECT name ,status, img, patient.number FROM friends inner 
         join patient on patient.number = friends.to_num 
         where friends.from_num = '$number' and  STATUS != 'cancel' ";

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
            }
            else
            {
               echo 'Error No Recored';
               //echo $q;
               }
         }
         else
         echo 'Error \n Failed to Get Data';
      }

      mysqli_close($conn);
  }

?>