<?php

  include('dbconnection.php');
 


  if(isset($_POST['createdBy']))
  {
     $createdBy = $_POST['createdBy'];
     $currDate = $_POST['date'];
     $title = $_POST['title'];
     $listOfMem = $_POST['listOfMem'];
     $img;
     $imgFound = false;
     if(isset($_File['img']))
     {   
        $imgFile = $_File['img'];

        $tempName = $_FILES['img']['name'] ;
        $target_file = "./assets/img/".$createdBy.$title.$tempName;
       
       if ( move_uploaded_file($_FILES['img']['tmp_name'], $target_file)){}

       $img = $target_file;

        $imgFound = true; 
     }    
    else
    {
      $img = '';
    }
   $alreadyExist = false ;
    $q = "select * from groups where title = '$title' ";
    if( $resG = mysqli_query($conn,$q))
    {
      if(mysqli_num_rows($resG) > 0)
      {
        $alreadyExist =true ;
        echo 'Already Exist';
        http_response_code(700); 
      }
    }
    print_r($alreadyExist);
if($alreadyExist == false){
    $q = "insert into groups(title,created_date,created_by,pic) values ('$title','$currDate','$createdBy','$img')";
    if(mysqli_query($conn,$q))
    {
      $g_id = mysqli_insert_id($conn);
      
      $arrayMem = json_decode($listOfMem);
    //  print_r($arrayMem);
     
      foreach($arrayMem as $value)
      {
        $item = json_decode($value);
        $number = $item->phone;
        //print_r($number);
        $role = $item->role;
        $q = "insert into groupmember(number,role) values ('$number','$role')";
        if(mysqli_query($conn,$q))
        {
          $m_id = mysqli_insert_id($conn);
          $q = "insert into grouphavemems(g_id,m_id) values ('$g_id','$m_id')";
          mysqli_query($conn,$q);
        }

      }
      echo strval($g_id)."_".strval($img);
      
      http_response_code(200);
    

    }
    else
    {
      http_response_code(400);
    }
     
  }
  else
  {
    http_response_code(404);
  }
  }
  else
  {

  }
  mysqli_close($conn);

?>