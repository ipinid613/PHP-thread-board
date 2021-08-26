 <?php
  session_start();

  include "/var/www/html/db_info.php";
 
  $max_thread_result=mysqli_query($conn, "select max(thread) from listt");
  $max_thread_fetch=mysqli_fetch_array($max_thread_result);

  $userId=$_POST['userId'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $title=$_POST['title'];
  $content=$_POST['content'];


  $max_thread=ceil($max_thread_fetch[0]/1000)*1000+1000;
  

  $query="insert into $board(thread,depth,userId,password,email,title,see,wdate,content) values($max_thread,0,'$userId','$password','$email','$title',0,now(),'$content')";
  
  $result=mysqli_query($conn, $query);


  mysqli_close($conn);


  echo "<meta http-equiv='refresh' content='1; URL=list.php?no=0'>";
  ?>
