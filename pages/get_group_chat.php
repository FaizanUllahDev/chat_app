<?php

  include('dbconnection.php');

  if(isset($_POST['to']))
  {
     $num = $_POST['to'] ;

              $q = "SELECT * FROM grouphavemems INNER JOIN groupmember ON groupmember.id = grouphavemems.m_id WHERE groupmember.number = '$num' ";
                     if($res = mysqli_query($conn , $q))
                     {
                        //print_r($q);
                         if(mysqli_num_rows($res) > 0)
                         {
                           $dataRows = array();
                           while($rows = mysqli_fetch_assoc($res)){
                             // array_push($dataRows , $rows);
                              $g_id = $rows['g_id'];
                             // echo $rows['id'];
                              $q13 = "SELECT groups.title ,groupchat.id as chatID ,doctor.name ,doctor.img ,groups.id as gid ,groupchat.time  ,groupchat.type, groupchat.from_id  ,groups.created_by , groups.pic , groupchat.msg FROM groups INNER JOIN groupchat ON groups.id = groupchat.gid INNER JOIN doctor ON doctor.number = groupchat.from_id WHERE groupchat.gid ='$g_id' and groupchat.to_id = '$num' ";
                             // echo $q1;
                              if($res1 = mysqli_query($conn , $q13))
                              {
                                 if(mysqli_num_rows($res1) > 0)
                                 {
                                       while($rowsd = mysqli_fetch_assoc($res1)){
                                       // print_r ($rowsd);
                                          if(strval($rowsd['from_id']) != strval($num))
                                          {
                                             array_push($dataRows , $rowsd);
                                             $chatid = $rowsd["chatID"];
                                             $q1 = "DELETE FROM groupchat WHERE id = '$chatid' and groupchat.to_id = '$num'";
                                            // echo $q1;
                                                   if(mysqli_query($conn , $q1));
                                          }
                                       }
                                 }
                                 else
                                 {
                                    $q13 = "SELECT groups.title ,patient.name,groupchat.id as chatID  ,patient.img ,groups.id as gid ,groupchat.time  ,groupchat.type, groupchat.from_id  ,groups.created_by , groups.pic , groupchat.msg FROM groups INNER JOIN groupchat ON groups.id = groupchat.gid INNER JOIN patient ON patient.number = groupchat.from_id WHERE groupchat.gid ='$g_id' and groupchat.to_id = '$num' ";
                                    // echo $q1;
                                     if($res1 = mysqli_query($conn , $q13))
                                     {
                                       if(mysqli_num_rows($res1) > 0)
                                       {
                                             while($rowsd = mysqli_fetch_assoc($res1)){
                                             // print_r ($rowsd);
                                                if(strval($rowsd['from_id']) != strval($num))
                                                {
                                                   array_push($dataRows , $rowsd);
                                                   $chatid = $rowsd["chatID"];
                                                   $q1 = "DELETE FROM groupchat WHERE id = '$chatid' and groupchat.to_id = '$num'";

                                                  //echo $q1;
                                                   if(mysqli_query($conn , $q1));
                                                }
                                             }
                                       }
                                     }
                                 }
                              }
                           }
                             echo json_encode($dataRows);

                        }


      
  }
  mysqli_close($conn);
}
  else echo "No ";

?>