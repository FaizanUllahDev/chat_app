<?php


include('dbconnection.php');
$data = array();

$num = $_POST['num'];

$q = "SELECT * from doctor INNER JOIN friends ON doctor.number = friends.to_num where friends.to_num = '$num' or friends.from_num = '$num'";
//echo $q;

              if($res = mysqli_query($conn , $q))
              {
                  if(mysqli_num_rows($res) > 0)
                  {
                     
                 while( $rows = mysqli_fetch_assoc($res))
                     array_push($data , $rows);
                     
                     
                 }
                 
                 {
                    $q = "SELECT * from doctor ";
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
                                  }
                                
                 }
              }
              else
              {
              echo 'Error 1';
              http_response_code(500);
              }


 

?>