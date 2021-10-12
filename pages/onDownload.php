<?php

  include('dbconnection.php');
  include('check_header.php');

if($token != "")
{
  if(isset($_POST['filename']))
  {
     $filename = $_POST['filename'] ;
     $type = $_POST['type'];
     $path;
                        if($type == "image")
                        {
                        $path = './assets/img/'.$filename;
                        }
                        if($type == "audio")
                        {
                        $path = './assets/audio/'.$filename;
                        }
                          if(unlink($path))
                              echo "ok";
                         else
                            echo "Error Unable To Delete";
                  
      mysqli_close($conn);
  }
  else echo "No Fields ";
}
else
{
   http_response_code(404);
}
?>