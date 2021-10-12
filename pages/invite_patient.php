 <?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['fromphone']))
  {
    $fromphone = $_POST['fromphone'];
    $tophone = $_POST['tophone'];
    $inviationCode = $_POST['inviationCode'];
    $time = $_POST['time'];
    $status = 'waiting';
    
      $q = "insert into invitation(from_Doctor,to_Patient,status,time,code) values('$fromphone','$tophone','$status','$time','$inviationCode') ";
      if(mysqli_query($conn , $q))
      {
        $qa = "insert into friends(from_num,to_num,status) values('$fromphone','$tophone','Request')";
        echo $qa;
        if(mysqli_query($conn , $qa))
            echo 'send Invitation';
        else
         echo 'Failed Q';
      }
      else
      echo 'Failed';

      mysqli_close($conn);
  }
}
?>