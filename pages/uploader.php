<?php

  include('dbconnection.php');
  $image = $_GET['from'];
 //$name = $_POST['name'];

  echo $image ;
  //echo $name;
  // $q = "insert into chatroom(fromid,toid,msg,type,time) values ('03158596789','03431530052','$image','image','') ";
   // if(mysqli_query($conn,$q))
    {
      
    }
//$path = "./assets/ccd/temp.jpg";
 // $status = file_put_contents($path,base64_decode($image));
if(true)
{
 echo "Successfully Uploaded";
}else{
 echo "Upload failed";
}
  

?>