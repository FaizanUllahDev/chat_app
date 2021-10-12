<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(isset($_POST['number']))
  {
     $num = $_POST['number'] ;
     $procQ = "SELECT formdataofpatient.pro FROM `formdataofpatient` WHERE formdataofpatient.number = (select number from patient WHERE number = '$num')  ORDER by formdataofpatient.curDate DESC LIMIT 1";
     $res = mysqli_query($conn , $procQ);
     if(mysqli_num_rows($res) > 0)
   {  $row  =mysqli_fetch_assoc($res);
     echo $row['pro'];
     http_response_code(200);}
     else
     {
       echo "";
     }

  }
}

?>