<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['from']))
  {
       //echo 'enter ';
       
      $from = $_POST['from'];
      
      $time = $_POST['time'];
   // echo $type;
     
               
          $q = "select * from ccd where filename = '$from' ";
          if($res = mysqli_query($conn,$q))
             if(mysqli_num_rows($res) > 0 )
             {
               $tempName = $_FILES['msg']['name'] ;
               $target_file = "./assets/ccd/".$from.".xml";
        
               if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
                   {$q = "update ccd set time = '$time' where  filename = '$from' ";
                      if(mysqli_query($conn,$q))
                             { 
                                echo $target_file;
                                  http_response_code(200);
                           }
                       else {echo 'Failed';}}
               else {echo 'Failed';}
               
             }
      
             else
             {
             $tempName = $_FILES['msg']['name'] ;
             $target_file = "./assets/ccd/".$from.".xml";
      
             if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
                 {$q = "insert into ccd(filename,time) values ('$from','$time') ";
                    if(mysqli_query($conn,$q))
                           { 
                              echo 'done';
                                http_response_code(200);
                         }
                     else {echo 'Failed';}}
             else {echo 'Failed';}
                   
          }
      
     
      
  }
   else echo "Invalid Access Failed";

   mysqli_close($conn);
}

?>