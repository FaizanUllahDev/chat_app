<?php

  include('dbconnection.php');

  if(ISSET($_POST['number']))
  {
     $number = $_POST['number'];
     $pro = $_POST['pro'];
     $med = $_POST['med'];
     $fromDoc = $_POST['fromDoc'];
     $paNumber = $_POST['paNumber'];
     $curDate = $_POST['curDate'];
     
     

     $q = "INSERT into formdataOfPatient (number,pro,med,fromDoc,paNumber,curDate) VALUES ('$number','$pro','$med','$fromDoc' , '$paNumber' , '$curDate')";
     if(mysqli_query($conn,$q))
     {
        http_response_code(200);
     }
     else
     http_response_code(404);
      mysqli_close($conn);
  }

?>