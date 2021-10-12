<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
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
                              $q = "select * from groups where id = '$g_id' ";
                                   if($resGroup = mysqli_query($conn,$q))
                                   {
                                      if(mysqli_num_rows($resGroup) >0 )
                                      {
                                       while($rowsgroup = mysqli_fetch_assoc($resGroup)){
                                          array_push($dataRows,$rowsgroup);
                                       }
                                      }
                                   }
                                   
                              }
                              
                             echo json_encode($dataRows);
                             http_response_code(200);
                           }
                           else
                           {
                              http_response_code(404);
                           }
                     }
                     else
                     {
                        http_response_code(500);
                     }
  }
  mysqli_close($conn);
}
else
{
   http_response_code(404);
}
?>