<?php

  include('dbconnection.php');

  if(ISSET($_POST['pnum']))
  {
      

       $phone  = $_POST['pnum'];
       $Dphone  = $_POST['docnum'];
       
  
          $q = "SELECT  * from formdataofpatient where fromDoc = '$Dphone' and number = '$phone'  ORDER BY curDate DESC LIMIT 1" ;

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
                        http_response_code(400);
                     }
                     else
                     http_response_code(404);

      mysqli_close($conn);
  }

?>