<?php
 session_start();

 if(!$_SESSION['id']){
	echo "<script>alert('로그인 먼저해주세요.');</script>";
	echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
 }

//오류코드 보이게 하기. 끄려면 ini_set 부분 삭제
 ini_set("display_errors",0);
 include "/var/www/html/db_info.php";
 $id=$_GET['id'];
 $no=$_GET['no'];
?>



<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
 <title>글 읽기</title>
 </head>
 
 <body topmargin=0 leftmargin=0 text="#464646">
  <center>
  <?php
   $result=mysqli_query($conn, "update listt set see=see+1 where id=$id");
  
   $result=mysqli_query($conn, "select id,thread,depth,userid,email,title,wdate,see,content from listt where id=$id");
   $row=mysqli_fetch_array($result);

  ?>

  <table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor="#777777">
   <tr>
    <td height=20 colspan=4 align=center bgcolor="#999999">
    <font color=white><strong><?php echo $row['title']?></strong></font>
    </td>
   </tr>
   <tr>
    <td width=100 height=20 align=center bgcolor="#EEEEEE">작성자</td>
    <td width=240 bgcolor=white><?php echo $row['userid']?></td>
    
    <td width=100 height=20 align=center bgcolor="#EEEEEE">이메일</td>
    <td width=240 bgcolor=white><?php echo $row['email']?></td>
   </tr>

   <tr>
    <td width=100 height=20 align=center bgcolor="#EEEEEE">날&nbsp;&nbsp;&nbsp;짜</td>
    <td width=240 bgcolor=white><?php echo $row['wdate']?></td>
    
    <td width=100 height=20 align=center bgcolor="#EEEEEE">조회수</td>
    <td width=240 bgcolor=white><?php echo $row['see']?></td>

   </tr>
<table width=500 border=0 cellpadding=2 cellspacing=1 bgcolor="#EEEEEE">
   <tr>

<!-- style을 아래와 같이 지정해야 출력 시 개행문자 제대로 표기됨. -->
    <td height=20 colspan=4 align=center bgcolor=white style="white-space: pre-line;">
    <font color=black><?php echo $row['content']?></font>
    </td>
   </tr>



   <tr>
    <td colspan=4 bgcolor="#999999">
     <table width=100%>
      <tr>
       <td width=230 align=left height=20>
       <a href="list.php?no=<?php echo $no?>"><font color=white>[목록보기]</font></a>
       <a href="write.php"><font color=white>[글작성]</font></a>
       <a href="edit.php?id=<?php echo $id?>"><font color=white>[수정]</font></a>
       <a href="delete.php?id=<?php echo $id?>"><font color=white>[삭제]</font></a>
       <a href="reply.php?id=<?=$id?>"><font color=white>[답글쓰기]</font></a>

       </td>
       <td align=right>

	<!--글의 종류가 새글일 경우 이전글/다음글, 답글일 경우 원글 보기 기능-->
        <?php
         if($row['depth']>=1){
		$thread=$row['thread'];
		$query=mysqli_query($conn, "select id from listt where thread > $thread limit 1");
	 	$original_id=mysqli_fetch_array($query);
		echo "<a href='read.php?id=$original_id[id]&no=$no'><font color=white>[원글 보기]</font></a>";
	 }

	 if($row['depth']==0){
	  	// 현재 게시물 id보다 id값이 큰 게시물 1개를 호출
		// 단, 그 게시물이 답글이 아닌 '원글' 이어야 하므로 depth=0 조건 포함
         	$query=mysqli_query($conn, "select id from listt where id>$id && depth=0 limit 1");
	 
	
         	$prev_id=mysqli_fetch_array($query); 
         	if($prev_id['id']){
          		echo "<a href='read.php?id=$prev_id[id]&no=$no'><font color=white>[이전글]</font></a>";
         	}
         	else{
          		echo "이전 글 없음  ";
         	}
          
         	$query=mysqli_query($conn, "select id from listt where id <$id && depth=0 order by id desc limit 1");
         	$next_id=mysqli_fetch_array($query);

         	if($next_id['id']){
          		echo "<a href='read.php?id=$next_id[id]&no=$no'><font color=white>[다음글]</font></a>";
         	}else{
          		echo "  다음 글 없음";
         	}
	 }
	 ?>
	       </td>
      </tr>
     </table>
    </b></font>
   </td>
   </tr>
  </table>

<?php
mysqli_close($conn);
?>
</center>
</body>
</html>
