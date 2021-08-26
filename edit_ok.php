<?php
session_start();
 include "/var/www/html/db_info.php";
 
 $name=$_POST['userid'];
 $email=$_POST['email'];
 $pass=$_POST['password'];
 $title=$_POST['title'];
 $content=$_POST['content'];
 $id=$_GET['id'];


 $result=mysqli_query($conn, "select password from $board where id=$id"); 
 $row=mysqli_fetch_array($result);

 if($pass==$row['password']){
  
 $query="update listt set userid='$name', title='$title',email='$email',content='$content' where id='$id'";
 
 $result=mysqli_query($conn, $query);
 echo "<script>alert('수정이 완료되었습니다.');</script>";
 }
 else{
 echo "<script>alert('비밀번호를 다시 확인해주세요.'); history.back();</script>";
 exit;
 }
 
 mysqli_close($conn);
 echo "<meta http-equiv='refresh' content='1; URL=read.php?id=$id'>";
?>
