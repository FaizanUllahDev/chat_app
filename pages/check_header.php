<?php

   
  include 'dbconnection.php' ;

   $token = "";
   $headers = apache_request_headers();
 
   if(isset($headers['authorization']))
   {
        
        $token =  $headers['authorization'];
        
       
        $q = "SELECT * FROM token where token = '$token' ";
        $res = mysqli_query($conn,$q);
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_assoc($res);
            $token = $row['token'];
                // if($token != "")
                // {
            //echo "Granted !";
            http_response_code(200);
                //}
                // else
                // {
                //     echo "Invalid Token !";
                //     http_response_code(404);
                // }
        }
        else
        {
            echo "Invalid Token !";
            http_response_code(404);
        }
   }

    

?>