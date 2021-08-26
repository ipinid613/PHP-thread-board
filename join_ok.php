<?php
 include "db_info.php";

 $j_userId=$_POST["userId"];
 $j_password=$_POST['password'];
 $j_re_password=$_POST['re_password'];
 $j_email=$_POST['email'];
 $j_chkid=$_POST['chk_id2'];
 

 if(!$j_userId||!$j_password||!$j_re_password||!$j_email){
  echo"<script>alert('빈칸없이 작성해 주세요.');history.back();</script>";
 }
 
 if($j_chkid==0){
  echo"<script>alert('아이디 중복확인을 해주세요.');history.back();</script>";
 }
 
 if($j_password!=$j_re_password){
  echo"<script>alert('비밀번호를 정확히 입력해주세요.');history.back();</script>";
 }

 if(!strpos($j_email,'@')){
 echo"<script>alert('올바른 이메일을 입력해주세요.');history.back();</script>";
 }

 $query="insert into member(userId, password, email) values('$j_userId','$j_password','$j_email')";
 $result=mysqli_query($conn, $query);
 echo "<script>alert('회원가입을 축하드립니다.');</script>";
 echo "<meta http-equiv='refresh' content='1; URL=login.php'>";
 

?>
