<?php

  include 'dbconnection.php' ;

//echo $_POST["phone"];

//Generate a random string.
$token = openssl_random_pseudo_bytes(256);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

// $token = null;
// $headers = apache_request_headers();
// if(isset($headers['Authorization'])){
//   $matches = array();
//   preg_match('/Token token="(.*)"/', $headers['Authorization'], $matches);
//   if(isset($matches[1])){
//     $token = $matches[1];
//   }
// } 



  if(!empty($_POST["phone"]))
  {
      
       $phone = $_POST['phone'];
        $count = 0; 
      
       $q = "select * from patient where number = '$phone'";
       if ($result=mysqli_query($conn,$q)) 
       if(mysqli_num_rows($result) ==  1 )
       {
           $data["role"] = "Patient";
           $data["token"] = $token;
          
           
           echo json_encode($data);
           
           http_response_code(200);
           $count = $count + 1;
       }
     else 
     {
        $q = "select * from doctor where number = '$phone'";
       
        if ($result=mysqli_query($conn,$q)) 
        if(mysqli_num_rows($result) ==  1 )
        {
           $q  = "select status from doctorrequested where number = '$phone' ";
           if ($result=mysqli_query($conn,$q)) 
           { 
             if( $rows = mysqli_fetch_assoc($result) )
             {
                
                 $data["role"] = "Doctor";
                 $data["token"] = $token;
                 $data['status'] = $rows["status"];
                
                 
                 echo json_encode($data);
                 
            http_response_code(200);
                 $count = $count + 1;
             }
          }
     
        }
      
      }
    if($count == 0)
    {
          $q = "select * from admin where number = '$phone'";
          if ($result=mysqli_query($conn,$q)) 
          if(mysqli_num_rows($result) ==  1 )
          {
            $data["role"] = "Admin";
            $data["token"] = $token;
           
            
            echo json_encode($data);
            
            http_response_code(200);
              $count = $count + 1;
          }
         // else $count = $count + 1;
    }
        if($count == 0)
        {

                $q = "select * from pa where number = '$phone'";
              // echo $q;
                if ($resultpa=mysqli_query($conn,$q)) 
                if(mysqli_num_rows($resultpa) ==  1 )
                {
                  $rowspa = mysqli_fetch_assoc($resultpa) ;     
                  // echo $rowspa;        
                  $data["role"] = "PA";
                  $data["token"] = $token;
                
                  
                  echo json_encode($data);
                  http_response_code(200);
                    $count = $count + 1;
                }
              // else $count = $count + 1;
        }

        if($count ==  0){
               echo 'Invalid Phone Number' ;
              http_response_code(401);
              }
         
      
            //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //   }
      $q = "INSERT INTO token(token,number) VALUES('$token' , '$phone' )";
      mysqli_query($conn,$q);
      mysqli_close($conn);
  }
  else
  echo 'error2';



?>