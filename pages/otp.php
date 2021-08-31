<?php


ini_set( 'sendmail_from', "faizanmehar649@gmail.com" ); 
ini_set( 'SMTP', "smtp.gmail.com" );  
ini_set( 'smtp_port', 25 );

$to = "03158596789@vtext.com";
$from = "faizanmehar649@gmail.com" ;
$msg = "Horrow" ;
$header = "From: $from\n";
mail($to , "" , $msg , $header);

?>