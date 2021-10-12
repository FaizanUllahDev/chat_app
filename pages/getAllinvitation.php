<?php

  include('dbconnection.php');
  include('check_header.php');

  if($token != "")
  {
   if(ISSET($_POST['phone']))
   {
         

         $phone  = $_POST['phone'];

            $q = "SELECT * from invitation where from_Doctor = '$phone'" ;

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
                           echo 'Failed';
                        }
                        else
                        echo 'Failed';

         mysqli_close($conn);
   }
  }
  else
{
   http_response_code(404);
}
?>