<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['phone']))
  {
      
      $phone = $_POST['phone'] ;


       $q = "select phone from user where phone = $phone";
       if ($result=mysqli_query($conn,$q)) 
       if(mysqli_num_rows($result) ==  1 )
       {
        $q = "select * from user where phone = '$phone' and inused = 'false' ";

        if ($result=mysqli_query($conn,$q)) {
          $rowcount=mysqli_num_rows($result);
          if($rowcount == 1)
          {
              $used = true ;
              $upq = "update user set inused = $used  where phone = $phone ";
              if (mysqli_query($conn,$q))
              {
                  echo 'ok';
              }
          }
          else
          {
              $q = "select * from user where phone = '$phone' and inused = 'true' ";
  
        if ($result=mysqli_query($conn,$q)) {
          $rowcount=mysqli_num_rows($result);
          if($rowcount == 1)
          {
              echo 'Already In Used On Another Device \n Uninstall Other Then Login Again ';
          }
      }
       }
        }
       }
       else{
           $used = true ;
          $q = "insert into user (phone , inused) values ('$phone' ,'$used')";
          if(mysqli_query($conn,$q))
          {
              echo 'registered';
          }
          else
          echo 'error';
    }
        
            //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //   }
      
      mysqli_close($conn);
  }
}
else
{
   http_response_code(404);
}
?>