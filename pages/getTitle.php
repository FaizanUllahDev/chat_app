<?php

  include('dbconnection.php');

  if(ISSET($_POST['pnum']))
  {
       //echo 'enter ';
       
      $pname = $_POST['pnum'];
      $dname = $_POST['dnum'];
      $data = array();
   // echo $type;
       $q = "SELECT allowTitles FROM refer WHERE doctorRefer = '$dname' and p_number = '$pname' ";
       if($res = mysqli_query($conn,$q))
       {
          if(mysqli_num_rows($res) > 0)
          {
               while($row = mysqli_fetch_assoc($res))
                 {   
                       array_push($data , $row['allowTitles']);

                 }
                 echo json_encode($data);
                  http_response_code(200);
          }
          else
          {
               
                 http_response_code(500);
          }
       }
       else
       {
            
                http_response_code(500);
       }
    
  }
  else
  {
       http_response_code(500);
  }
  mysqli_close($conn);


?>