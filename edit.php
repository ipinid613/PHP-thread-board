 <?php
session_start();

if(!$_SESSION['id']){
		echo "<script>alert('로그인 먼저해주세요.');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
	}

 
 include "/var/www/html/db_info.php";
 $id=$_GET['id'];

 $result=mysqli_query($conn, "select id,userid,email,title,content from $board where id=$id");
 $row=mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
 <title>게시글 수정</title>
 </head>
 <body topmargin=0 leftmargin=0>
 
 <center>
 <br>
 <form action="edit_ok.php?id=<?=$id?>" method=post>
 <?php
?> 
 <table width=580 border=0 cellpadding=2 cellspacing=1 bgcolor="#777777">
  
 <tr>
  <td height=20 align=center bgcolor="#999999">
  <font color=white><strong>글 수 정 하 기</strong></font>
  </td>
 </tr>
 <tr>
  <td bgcolor=white>&nbsp;
  <table>
  <tr>
   <td width=60 align=left>작성자</td>
   <td align=left>
   <input type=text name=userid size=20 maxlength=10 value="<?php echo $_SESSION['id']?>">
   </td>
  </tr>
  <tr>
   <td width=60 align=left>이메일</td>
   <td align=left><input type=text name=email size=30 maxlength=25 value="<?php echo $_SESSION['email']?>">
   </td>
  </tr> 
  
  <tr>
   <td width=60 align=left>비밀번호</td>
   <td align=left><input type=password name=password maxlength=8>(수정, 삭제시 필요합니다.)</td>
  </tr>
  <tr>
   <td width=60 align=left>제목</td>
   <td align=left><input type=text name=title size=60 maxlength=35 value="<?php echo $row['title']?>">
   </td>
  </tr>
 
  <tr>
   <td width=60 align=left>내용</td>
   <td align=left><TEXTAREA name=content cols=64 rows=15><?php echo $row['content']?></TEXTAREA>
   </td>
  </tr>
  <tr> 
   <td colspan=10 align=center>
   <input type=submit value="수정하기">
   &nbsp;&nbsp;&nbsp;
   <input type=reset value="다시 작성">
   &nbsp;&nbsp;&nbsp;
   <input type=button value="뒤로 가기" onclick="history.back()">
   </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  <input type=hidden value="<?php echo $id?>">
 </form>
 </center>
 </body>
</html>
