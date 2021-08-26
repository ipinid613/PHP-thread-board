<?php
 session_start();
 include "/var/www/html/db_info.php";

 $userId=$_POST['id'];
 $password=$_POST['pw'];
 
 $query="select userId, email from member where userId='$userId' && password='$password'";
 
 $result=mysqli_query($conn, $query);
 $row=mysqli_fetch_array($result);
 
 $email=$row['email'];

 $keepLoggedIn = isset($_REQUEST['chkbox']);
 if($row && $keepLoggedIn){
   $_SESSION['id']=$userId;
   $_SESSION['email']=$row['email'];
   $oneHour = 60*60*60;
   $a = setcookie("userId", $userId, time() + $oneHour);
   $b = setcookie("password", $password, time() + $oneHour);
   $c = setcookie("email", $email, time() + $oneHour);
   // 1초 후 해당 url로 리다이렉트 
   echo "<meta http-equiv='refresh' content='0; URL=list.php?no=0'>";
   exit;
 } elseif ($row){
   $_SESSION['id']=$userId;
   $_SESSION['email']=$row['email'];

   // 1초 후 해당 url로 리다이렉트 
   echo "<meta http-equiv='refresh' content='0; URL=list.php?no=0'>";
   exit;
 } else {
   echo "<script>alert('아이디와 비밀번호를 확인해주세요.');history.back();</script>";
   exit;
 }
 mysqli_close($conn);
?>
