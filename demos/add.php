<?php
  session_start();

  $user='root';
  $pass='';
  $db='calendar';
  $db=new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");

  $title=$_POST['title'];
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  
  $sql="INSERT INTO data (title,start_date,end_date) VALUES ('$title','$detail','$image')";
  if(mysqli_query($db,$sql)){
    echo 1;
  } 
  else 
  {
    echo 0;
  }
?>