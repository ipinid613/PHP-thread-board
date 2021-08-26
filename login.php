<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
  <title>
   로그인 페이지
  </title>
 </head>
 <body bgcolor=white>
 <center>
  <h1>게시판 로그인</h1>
  <br><br>
  <form name=frm1 action="login_ok.php" method=post>
   <table cellpadding=2>
   <tr>
    <td colspan=2><font color=black>로그인을 위해 아이디와 비밀번호를 입력해주세요.
    </td>
   </tr>
   <tr>
    <td><font color=black>ID</td>
    <td><input type=text name="id"></td>
   </tr>
   <tr>
    <td><font color=black>PW</td>
    <td><input type=password name="pw"></td>
   </tr>
   <tr>
    <td>
      <input type="checkbox" id="keepLoggedIn" name="chkbox"><span><label for="keepLoggedIn">로그인 상태 유지</span>
    </td>
    <td colspan=2 align=center><input type=submit value="로그인">&nbsp;&nbsp;<input type=button value="회원가입" onclick="location.href='join.php'">
    </td>
   </tr>
</table>
  </form>
 </center>
 </body>
</html>

