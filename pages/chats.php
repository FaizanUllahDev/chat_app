<?php

  include('dbconnection.php');

  if(ISSET($_POST['type']))
  {
       //echo 'enter ';
       
      $from = $_POST['from'];
      $to = $_POST['to'];
      $type = $_POST['type'];
      $time = $_POST['time'];
   // echo $type;
      if($type == 'text')
      {
          
           $msg = $_POST['msg'];
           
                $q = "insert into chatroom(fromid,toid,msg,type,time) values ('$from','$to','$msg','$type','$time') ";
               //echo $q;
               if(mysqli_query($conn,$q))
                      { echo 'ok';}
                else {echo 'Failed';}
          
      }
      else if($type == "audio")
      {
             
             $tempName = $_FILES['msg']['name'] ;
             //$n = explode(" ",$str[0]);
             $target_file = "./assets/audio/".$tempName;
      
             if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
                 {$q = "insert into chatroom(fromid,toid,msg,type,time) values ('$from','$to','$tempName','$type','$time') ";
                    if(mysqli_query($conn,$q))
                           { echo 'ok';}
                     else {echo 'Failed';}}
             else {echo 'Failed';}
           
      }
      else if($type == "image")
      {
         //  echo 'image enter';
        //$file = $_FILES['file'];
        $tempName = $_FILES['msg']['name'] ;
        $currentDateTime = date('Y-m-d H:i:s');
        $name = '';
        foreach ($currentDateTime as $value) {
              $name .= strval($value);
              echo (string)$value;
              echo "checj phph- - ".$name;
        }

        $target_file = "./assets/img/".strval($from).$tempName;
        $newName = strval($from).$tempName;
 
        if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
             {
                  $q = "insert into chatroom(fromid,toid,msg,type,time) values ('$from','$to','$newName','$type','$time') ";
               if(mysqli_query($conn,$q))
                      {  $last_id = mysqli_insert_id($conn);
                           echo $last_id;
                           http_response_code(200);
                         }
                else {echo 'Failed';}
          }
           else {echo 'Failed';}
      }
      else {
          echo $type; 
          echo 'type Failed';}
      
  }
   else echo "Invalid Access Failed";

  mysqli_close($conn);


?>