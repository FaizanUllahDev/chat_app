<?php

  include 'dbconnection.php' ;


  if(!empty($_POST["phone"]))
  {
      $file = '';
      $uploadOk = false ;
      $isImage = false ;

      $number = $_POST['phone'] ;
      $name = $_POST['name'] ;
      $code = $_POST['code'] ;
     // $img = $_POST['img'] ;
      $role = $_POST['role'] ;
      $time = $_POST['time'];

     // echo $role;
      
    // echo $_FILES['img']['tmp_name'];
      if(!empty($_FILES['img']))
      {
        $file = $_FILES['img']['tmp_name'];
       // echo $file;
        $isImage = true ;
      }
      
      


         


      if($role == "Doctor"){
         $q = "select * from doctor where number = '$number'  ";
         if($res = mysqli_query($conn , $q))
         if(mysqli_num_rows($res) < 1)
         {
           $qry= '';
           if(!$isImage)
           $qry = "insert into doctor (number,name,img,time) values ('$number' , '$name' ,'','$time') ";
           else
           {
             
             $tempName = $_FILES['img']['name'] ;
             //$tempName = str_replace("_","" ,"_");
            // $tempName = $time.'chatimg'.$tempName;
            //echo $tempName;
            $target_file = "./assets/img/".$tempName;
           
           if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
             $uploadOk = true ;
             $qry = "insert into doctor (number,name,img,time) values ('$number' , '$name' ,'$tempName','$time') ";
              //echo "The file ". htmlspecialchars( basename($_FILES["img"]["tmp_name"])). " has been uploaded.";
             } 
           }

           if(mysqli_query($conn,$qry))
           {
             $q = "insert into doctorrequested(number,status) values ('$number','Pending')" ;
             if(mysqli_query($conn,$q))
             {
               echo 'ok';
             }
              else
              echo "Failed ... ";
           }
           else
              echo "Failed ... ";
         }
         else
          echo "Doctor Already Exist ";
      }
      else
      {
        //echo 'pa';
        $q = "select * from patient where number = '$number'  ";
        if($res = mysqli_query($conn , $q))
        if(mysqli_num_rows($res) < 1)
        {
            $Doc_num;
          $q = "select from_Doctor from invitation where to_Patient= '$number' and code ='$code' ";
          if($res = mysqli_query($conn , $q))
        if(mysqli_num_rows($res) >= 1)
        {
          $rows = mysqli_fetch_assoc($res);
          $Doc_num = $rows['from_Doctor'];
          $qr = '';
          if(!$isImage)
          $qr = "insert into patient (number,name,img,time) values ('$number' , '$name' ,'','$time') ";
          else
          {
            $tempName = $_FILES['img']['name'] ;
            $target_file = "./assets/img/".$tempName;
          
          if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
            $uploadOk = true ;
            $qr = "insert into patient (number,name,img,time) values ('$number' , '$name' ,'$tempName','$time') ";
           //echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["tmp_name"])). " has been uploaded.";
            } 
          }

          if(mysqli_query($conn,$qr))
           {
                   
                   $update = "update invitation set status = 'Accept'  where to_Patient = '$number' ";
                   if(mysqli_query($conn,$update))
                       {
                        $update = "update friends set status = 'Accept'  where to_num = '$number' ";
                        if(mysqli_query($conn,$update))
                        {
                        echo 'ok';  
                        http_response_code(200);
                        }
                        else
                        echo 'Error';  
                       }
                   else
                   echo 'Error';  


                  
           }
           else
              echo "Failed ... ";
          }
          else
          echo "\nInvalid Invitation  ... ";
        }
        else
         echo "Patient Already Exist ";
      }
  }
  else
    echo 'Error Phone';




  
?>