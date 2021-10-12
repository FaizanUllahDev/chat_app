<?php
   
   
  include 'dbconnection.php' ;
  include('check_header.php');

if($token != "")
{
  if(isset($_POST['phone']))
  {
      $name = $_POST['name'] ;
      $phone = $_POST['phone'];
     
      $role = $_POST['role'];
      
      // echo $_FILES['img']['tmp_name'];
      if(!empty($_FILES['img']))
      {
        
         $preImg = $_POST['preimg'];
        $img = $_FILES['img'];
        $tempName = $_FILES['img']['name'] ;
       $target_file = "./assets/img/".$tempName;
      
      if ( move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
          
        $q = "update $role set img = '$tempName'  , name = '$name' where number = '$phone' "; 
        if(mysqli_query($conn,$q ))
        { 
            
            $filename = $preImg;
            $path = './assets/img/'.$filename;
             // unlink($path);
              echo "done";
              echo $q;
                http_response_code(200);
        }
    }
    else
    {
      echo "File Error";
      http_response_code(300);
    } 
      }

      else
      {
        $q = "update $role set name = '$name' where number = '$phone' "; 
        if(mysqli_query($conn,$q ))
        {
          echo "save....";
             http_response_code(200);
        }
        else
        {
          echo $q;
          
            http_response_code(500);
        }
      }
      
  }
  else
  {
    echo "Not FOund";
    http_response_code(500);
  }

}
else
{
   http_response_code(404);
}


?>