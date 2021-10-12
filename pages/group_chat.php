<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(ISSET($_POST['type']))
  {
       //echo 'enter ';
       
      $from = $_POST['from'];
      $to = $_POST['to'];
      $type = $_POST['type'];
      $time = $_POST['time'];

      $members = array();


      $q = "SELECT number from groupmember INNER JOIN grouphavemems ON  grouphavemems.m_id = groupmember.id WHERE  grouphavemems.g_id = '$to' ";
      if($res = mysqli_query($conn , $q))
        while($membersRows = mysqli_fetch_assoc($res))
        {
           if($membersRows['number'] != $from)
             array_push($members , $membersRows['number']);
        }
        

    echo $type;
      if($type == 'text')
      {
          
           $msg = $_POST['msg'];
             
             foreach ($members as $key => $value) {
                  # code...
                  $q = "insert into groupchat(from_id,gid,msg,type,time,to_id) values ('$from','$to','$msg','$type','$time','$value') ";
               //echo $q;
               if(mysqli_query($conn,$q))
               {
                 // echo "done";
               }

             }
           
               //  $q = "insert into groupchat(from_id,gid,msg,type,time) values ('$from','$to','$msg','$type','$time') ";
               // //echo $q;
               // if(mysqli_query($conn,$q))
               //        { 
                         http_response_code(200);
               //      }
               //  else {http_response_code(404);}
          
      }
      else if($type == "audio")
      {
             
             $tempName = $_FILES['msg']['name'] ;
             //$n = explode(" ",$str[0]);
             
             $target_file = "./assets/audio/".strval($from).$tempName;
             $newName = strval($from).$tempName;
      
             if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
                 {
                    foreach ($members as $key => $value) {
                         # code...
                         $q = "insert into groupchat(from_id,gid,msg,type,time,to_id) values ('$from','$to','$newName','$type','$time','$value') ";
                      //echo $q;
                      if(mysqli_query($conn,$q));
                    }
                     http_response_code(200);
                  }
             else {http_response_code(404);}
           
      }
      else if($type == "image")
      {
         //  echo 'image enter';
        //$file = $_FILES['file'];
        $tempName = $_FILES['msg']['name'] ;
        $currentDateTime = date('Y-m-d H:i:s');
        $name = '';
        $name =  explode($currentDateTime ," ")[0] + explode($currentDateTime ," ")[1];
     //    foreach ($currentDateTime as $value) {
     //          $name .= strval($value);
     //          echo (string)$value;
     //          echo "checj phph- - ".$name;
     //    }

     echo $name;

        $target_file = "./assets/img/".strval($from).$tempName;
        $newName = strval($from).$tempName;
 
        if (move_uploaded_file($_FILES['msg']['tmp_name'], $target_file)) 
             {
                 
                         foreach ($members as $key => $value) {
                              # code...
                              $q = "insert into groupchat(from_id,gid,msg,type,time,to_id) values ('$from','$to','$newName','$type','$time','$value') ";
                           //echo $q;
                           if(mysqli_query($conn,$q));
                         }
                          http_response_code(200);

               
          }
           else {echo 'Failed';}
      }
      else {
          echo $type; 
          echo 'type Failed';}
      
  }
   else echo "Invalid Access Failed";

     mysqli_close($conn);

}
else
{
   http_response_code(404);
}
?>