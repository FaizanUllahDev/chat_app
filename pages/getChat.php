<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(isset($_POST['to']))
  {
     $num = $_POST['to'] ;

     ///SELECT chatroom.* , doctor.name FROM `chatroom` 
     //INNER JOIN doctor ON chatroom.toid = doctor.number WHERE toid = '03431530052'



   



              $q = "SELECT chatroom.* , doctor.name , doctor.img FROM chatroom INNER JOIN doctor ON chatroom.fromid = doctor.number WHERE toid = '$num' ";
      // echo $q;
    
                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                           $dataRows = array();
                           while($rows = mysqli_fetch_assoc($res)){
                              $rows['role'] = "doctor";
                              array_push($dataRows , $rows);
                              $id = $rows['id'];
                             // echo $rows['id'];
                              $q1 = "DELETE FROM chatroom WHERE id = '$id' ";
                             // echo $q1;
                              if(mysqli_query($conn , $q1))
                              {}
                           }
                             echo json_encode($dataRows);

                        }
                        else
                           {
                              $q = "SELECT chatroom.* , patient.name , patient.id as mr , patient.img FROM chatroom INNER JOIN patient ON chatroom.fromid = patient.number WHERE toid = '$num' ";
      // echo $q;
    
                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                           $dataRows = array();
                           while($rows = mysqli_fetch_assoc($res)){
                              $rows['role'] = "patient";
                              array_push($dataRows , $rows);
                              $id = $rows['id'];

                             // echo $rows['id'];
                              $q1 = "DELETE FROM chatroom WHERE id = '$id' ";
                             // echo $q1;
                              if(mysqli_query($conn , $q1))
                              {}
                           }
                             echo json_encode($dataRows);

                        }
                        
                     }
               
                     }
                  }
                     else
                     echo 'Error 1';

      mysqli_close($conn);
  }
  else echo "No ";
}
else
{
   http_response_code(404);
}
?>