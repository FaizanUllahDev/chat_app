<?php

  include('dbconnection.php');

  if(isset($_POST['phone']))
  {
     $num = $_POST['phone'] ;
     $tablename = $_POST['table'];
    $q = "SELECT * FROM $tablename where number =  '$num' ";
       //echo $q;
    
                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                            
                         $rows = mysqli_fetch_assoc($res);
                         
                         echo json_encode($rows);
                         http_response_code(200);
                        }
                        else
                        {echo 'Error 0';
                           http_response_code(400);}
                     }
                     else
                     {echo 'Error 1';http_response_code(400);}

      mysqli_close($conn);
  }
  else echo "No ";

?>