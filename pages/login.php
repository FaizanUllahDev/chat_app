<?php

  include 'dbconnection.php' ;

//echo $_POST["phone"];

//Generate a random string.
$token = openssl_random_pseudo_bytes(16);

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

//Print it out for example purposes.
echo $token;

data = array();


  if(!empty($_POST["phone"]))
  {
      
       $phone = $_POST['phone'];
        $count = 0; 
      
       $q = "select * from patient where number = '$phone'";
       if ($result=mysqli_query($conn,$q)) 
       if(mysqli_num_rows($result) ==  1 )
       {
           data["role"] = "Patient";
           data["token"] = $token;
           echo data;
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
                 echo 'Doctor_'.$rows["status"];
                 $count = $count + 1;
             }
          }
     
        }
      
      }
    if($count == 0){
          $q = "select * from admin where number = '$phone'";
          if ($result=mysqli_query($conn,$q)) 
          if(mysqli_num_rows($result) ==  1 )
          {
              echo 'Admin';
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
              echo 'pa_'.$rowspa['asgTo'] ;
              $count = $count + 1;
          }
         // else $count = $count + 1;
  }

  if($count ==  0)
               echo 'Invalid Phone Number' ;
         
      
            //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //   }
      
      mysqli_close($conn);
  }
  else
  echo 'error2';



?>