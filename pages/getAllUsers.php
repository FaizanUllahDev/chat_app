<?php

  include('dbconnection.php');
 $data = array();
 include('check_header.php');

if($token != "")
{
  
    $q = "SELECT * from patient  ";
       //echo $q;
    
                     if($res = mysqli_query($conn , $q))
                     {
                         if(mysqli_num_rows($res) > 0)
                         {
                            
                        while( $rows = mysqli_fetch_assoc($res))
                        array_push($data , $rows);
                        }
                        else
                        echo 'Error 0';
                     }
                     else
                     echo 'Error 1';


                     $q = "SELECT * from doctor  ";
                     //echo $q;
                  
                                   if($res = mysqli_query($conn , $q))
                                   {
                                       if(mysqli_num_rows($res) > 0)
                                       {
                                          
                                      while( $rows = mysqli_fetch_assoc($res))
                                          array_push($data , $rows);
                                      }
                                      else
                                      echo 'Error 0';
                                   }
                                   else
                                   echo 'Error 1';


                      echo json_encode($data);
                      

      mysqli_close($conn);
 

}
?>