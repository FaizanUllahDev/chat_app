<?php


include('dbconnection.php');
$data = array();
if(isset($_POST['num']))
{
 $num =  $_POST['num'];
        $q = "SELECT * from refer inner join patient on patient.number = refer.p_number where refer.p_number  = '$num' ";
//echo $q;

              if($res = mysqli_query($conn , $q))
              {
                  if(mysqli_num_rows($res) > 0)
                  {
                     
                     while( $rows = mysqli_fetch_assoc($res))
                     array_push($data , $rows);
                     
                     echo json_encode($data);
                     http_response_code(200);
                  }
                  else
                  http_response_code(400);
                 
                
              }
              else
              {
              echo 'Error 1';
              http_response_code(500);
              }


            }

?>