<?php

  include('dbconnection.php');

  if(ISSET($_POST['doctorRefer']))
  {

   $doctorRefer = $_POST['doctorRefer'];
   $referFrom = $_POST['referFrom'];
   $json = $_POST['allowTitles'];
   $pnumber = $_POST['p_number'];
   
      
    $q = "select * from refer where referFrom = '$referFrom' and doctorRefer = '$doctorRefer' and p_number = '$pnumber' ";

                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                           http_response_code(300);
                        }
                        else
                        {
                           $q = "insert into refer(referFrom,doctorRefer,allowTitles,p_number) values ('$referFrom' , '$doctorRefer' , '$json' ,'$pnumber')";
                           if($res = mysqli_query($conn , $q))
                           {
                              $q = "insert into friends(from_num,to_num,status) values ('$referFrom' , '$doctorRefer' , 'Accept')";
                              if($res = mysqli_query($conn , $q))
                              http_response_code(200);
                           }
                           else
                           {
                              http_response_code(500);
                           }
                        }
                     }
                     else
                     { http_response_code(500);}

      mysqli_close($conn);
  }
  else
  {
   http_response_code(500);
  }

?>