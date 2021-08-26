<?php
 session_start();
 if(!$_SESSION['id']){
		echo "<script>alert('로그인 먼저해주세요.');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
	}


?>
<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
  <title>게시판</title>
 </head>
 <body topmargin=0 leftmargin=0 text="#464646">
 <center>

 <br>
 <form action="write_ok.php" method=post>
 <table width=580 border=0 cellpadding=2 cellspacing=1 bgcolor="#777777">
  <tr>
  <td height=20 align=center bgcolor="#999999">
  <font color=white><strong>글쓰기</strong></font>
  

  </td>
  </tr>
  <tr>
  <td bgcolor=white>&nbsp;
  <table>
  <tr>
   <td width=160 align=left>작성자</td>
   <td align=left><input type=text name="userId" value="<?php echo $_SESSION['id']?>" size=20 maxlength=10 readonly>
   </td>
  </tr>
  <tr>
   <td width=160 align=left>E-mail</td>
   <td align=left><input type=test name="email" value="<?php echo $_SESSION['email']?>" maxlength=25 readonly>
   </td>
  </tr>
  <tr>
   <td width=160 align=left>비밀번호</td>
   <td align=left>
    <input type=password name="password" size=8 maxlength=8>(수정, 삭제시 필요합니다.)
   </td>
  </tr>
  <tr>
   <td width=160 align=left>제목</td>
   <td align=left>
    <input type=text name="title" size=60 maxlength=35>
   </td>
  </tr>
  <tr>
   <td width=160 align=left>내용</td>
   <td align=left><TEXTAREA name="content" cols=65 rows=15></TEXTAREA>
  </td>
  </tr>

  <tr>
   <td colspan=10 align=center>
    <input type=submit value="글쓰기">
   &nbsp;&nbsp;
   <input type=reset value="다시 작성">
   &nbsp;&nbsp;
   <input type=button value="뒤로 가기" onclick="history.back()">
  </td>
  </tr>
  </table>
  </form>
  </center>
 </body>
</html>
