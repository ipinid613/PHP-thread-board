<?php
 session_start();
 if(!$_SESSION['id']){
		echo "<script>alert('로그인 먼저해주세요.');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
	}


 $id=$_GET['id'];
?>


<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
 <title>
 글삭제하기</title>
 </head>
 <body topmargin=0 leftmargin=0 text="#464646">
 <center>
 <form action="delete_ok.php?id=<?php echo $id?>" method=post>
 
 <table width=300 botder=0 collpadding=2 cellspacing=1 bgcolor="#777777">
 <tr>
  <td height=20 align=center bgcolor="#999999">
   <font color=white><strong>비 밀 번 호 확 인</strong></font>
  </td>
 </tr>
 <tr>
  <td align=center>
   <font color=white><strong>비밀번호 : </strong>
   <input type=password name=password maxlength=8>
   <input style="margin-top: 10px;" type=submit value="확인">
   &nbsp;
   <input type=button value="취소" onclick="history.back()">
  </td>
 </tr>
 </table>
 </body>
</html>


