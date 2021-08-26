<?php
 include "/var/www/html/db_info.php";

 $id=$_GET['id'];
 $password=$_POST['password'];

 $result=mysqli_query($conn, "select password from $board where id=$id");
 $row=mysqli_fetch_array($result);

 if($password==$row['password']){
 $query="delete from $board where id=$id";
 $result=mysqli_query($conn, $query);
 echo "<script>alert('삭제 완료!');</script>";
 }
 else{
 echo "<script>alert('비밀번호를 다시 확인해주세요.'); history.back();</script>";
 exit;
 }

?>
<center>
<meta http-equiv='refresh' content='1; URL=list.php?no=0'>
