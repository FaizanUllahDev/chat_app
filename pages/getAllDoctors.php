<?php


    include('dbconnection.php');
    include('check_header.php');

if($token != "")
{
    $data = array();

    $num = $_POST['num'];



                                  $q = "SELECT * from doctor  ";
                    
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
                                  else
                                  http_response_code(404);


}
else
{
   http_response_code(404);
}

                                  // $q = "SELECT * from doctor inner JOIN friends ON doctor.number = friends.to_num where friends.to_num = '$num' or friends.from_num = '$num'";


//               if($res = mysqli_query($conn , $q))
//               {
//                   if(mysqli_num_rows($res) > 0)
//                   {
                     
//                  while( $rows = mysqli_fetch_assoc($res))
//                      array_push($data , $rows);
                     
                     
//                  }
//                 if(count($data) > 0)
//                 {
//                  foreach($data as $key => $record )
//                  {
//                      $n = $record['number'];
                 
//                     $q = "SELECT * from doctor where number != '$n' Limit 1 ";
//                    echo $q;
                    
//                                   if($res = mysqli_query($conn , $q))
//                                   {
//                                       if(mysqli_num_rows($res) > 0)
//                                       {
//                                         while( $rows = mysqli_fetch_assoc($res))
//                                         array_push($data , $rows);
                                        
                                   
//                                       }
//                                   }
                                
//                  }
                 
//                                         echo json_encode($data);
//                                         http_response_code(200);
//                 }
//                 else
//                  $q = "SELECT * from doctor  ";
                    
//                                   if($res = mysqli_query($conn , $q))
//                                   {
//                                       if(mysqli_num_rows($res) > 0)
//                                       {
//                                         while( $rows = mysqli_fetch_assoc($res))
//                                         array_push($data , $rows);
                                        
//                                         echo json_encode($data);
//                                         http_response_code(200);
                                   
//                                       }
//                                   }
//               }
//               else
//               {
//               echo 'Error 1';
//               http_response_code(500);
//               }


 

?>