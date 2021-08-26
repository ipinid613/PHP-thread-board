 <?php
	session_start();
	include "/var/www/html/db_info.php";

	if(isset($_COOKIE["userId"]) && isset($_COOKIE["email"])){
		$_SESSION["id"] = $_COOKIE["userId"];
		$_SESSION["email"] = $_COOKIE["email"];
	}
	
	$no=($_GET["no"])?$_GET["no"]:0; //3항 연산자를 활용(조건?참일 경우 실행문:거짓일 경우 실행문;)
	$page_size=10;
	$page_list_size=10;

	if(!$no||$no<0)$no=0;

	$query="select id,thread,depth,userid,email,title,content,DATE_FORMAT(wdate,'%Y-%m-%d') as wdate, see from $board order by thread desc, wdate desc limit $no,$page_size";

	//쿼리 성공여부 반환(true, false)
	//위 쿼리를 정상적으로 수행 했는지 아닌지
	// mysqli_result Object ( [current_field] => 0 [field_count] => 9 [lengths] => [num_rows] => 10 [type] => 0 )
	$result=mysqli_query($conn, $query);

	//쿼리 성공여부 반환. 테이블에 저장된 레코드들의 count를 정상적으로 불러왔는지 아닌지)
	//mysqli_result Object ( [current_field] => 0 [field_count] => 1 [lengths] => Array ( [0] => 2 ) [num_rows] => 1 [type] => 0 )
	$result_count=mysqli_query($conn, "select count(*) from $board");

	//$result_count의 결과를 Array형태로 보여줌.
	//Array ( [0] => 12 [count(*)] => 12 )
	$result_row=mysqli_fetch_array($result_count);

	//12 출력
	$total_row=$result_row[0];

	if($total_row<=0)$total_row=0;


	//total_row 의 수에 따라 페이지네이션 하기 위한 부분
	//ex 레코드가 11개일 경우? floor((12-1/10)) = 1
	$total_page=floor(($total_row-1)/$page_size);

	$current_page=floor($no/$page_size);

	if(!$_SESSION['id']){
		echo "<script>alert('로그인 먼저해주세요.');</script>";
		echo "<meta http-equiv='refresh' content='0; URL=login.php'>";
	}
?>
<!DOCTYPE html>
<html>
 <head lang="ko">
 <meta charset="utf-8">
     <title> 게시글 목록</title>
 </head>
 <body topmargin=0 leftmargin=0 text="#464646">
     <center>
	<div>
	   <h1> 자유게시판 </h1>
	</div>
         <?php echo $_SESSION['id']?>님 어서오세요.<br>
         <?php echo $_SESSION['email']?><br>
	 <input type=button value="로그아웃" onclick="location.href='logout.php'">

         <br><br>
         <p>
         <table width=580 border=0 collpadding=2 cellspacing=1 bgcolor="#777777">
             <tr height=20 bgcolor="#999999">
                 <td width=30 align=center>
                     <font color=white>번호</font>
                 </td>
                 <td width=350 align=center>
                     <font color=white>제목</font>
                 </td>
                 <td width=50 align=center>
                     <font color=white>작성자</font>
                 </td>
                 <td width=100 align=center>
 		     <font color=white>작성일자</font>
                 </td>
                 <td width=50 align=center>
                     <font color=white>조회수</font>
                 </td>
	     </tr>
             <?php
		while($row=mysqli_fetch_array($result))
			//테이블의 레코드들을 반복문으로 Array 형태로 불러옴
			//이 때 1페이지에 해당하는 10개의 레코드만 불러옴.
			//로직은 위의 쿼리문에 있음 ...
		{
		?>
		<tr>
                 <td height=20 bgcolor=white align=center>
                     <a href="read.php?id=<?php echo $row['id']?>&no=<?php echo $no?>" title="글 번호입니다. 클릭 시 본문으로 이동합니다."><?php echo $row['id']?></a>
                 </td>
                 <td height=20 bgcolor=white>&nbsp;
			<!--답글 작성 시 indent 처리 로직 -->
                     <?php
			$nbsp = "&nbsp";
			if($row['depth']>0) 
			echo str_repeat($nbsp, $row['depth']*3)."<img src='/image/arrow.png' height=15 width=15>"; 
			?>

                     <a href="read.php?id=<?=$row['id']?>&no=<?php echo $no?>" title="글 제목입니다. 클릭 시 본문으로 이동합니다.">
                         <?php echo strip_tags($row['title'],'<b><i>')?>&nbsp;
                     </a>
                 </td>
                 <td align=center height=20 bgcolor=white>
                     <font color=black>
                         <a href="mailto:<?php echo $row['email']?>" title="작성자입니다. 클릭 시 이메일 발송으로 연결됩니다."><?php echo $row['userid']?></a>
                     </font>
                 </td>
                 <td align=center height=20 bgcolor=white>
                     <font color=black title="글 작성일자입니다."><?php echo $row['wdate']?></font>
                 </td>
                 <td align=center height=20 bgcolor=white>
                     <font color=black title="글 조회수입니다."><?php echo $row['see']?></font>
                 </td>
             </tr>
             <?php
			}
			mysqli_close($conn);
		?>
         </table>
         <table border=0>
             <tr>
                 <td width=600 height=20 align=center rowspan=4>
                     <font color=gray>
                         &nbsp;
                         <?php
							//start_page = (1/10)*10 = 1
							$start_page=(int)($current_page/$page_list_size)*$page_list_size;
							//end_page = (1+10)-1 = 10
							$end_page=$start_page+$page_list_size-1;
							//if(1 < 10) -> end_page = 1
							if($total_page<$end_page)$end_page=$total_page;
							//if(1 >= 10) -> prev_list = 
							for($i=$start_page;$i<=$end_page;$i++){
								
								// page = 0(10*0), 10(10*1), 20.. 순
								$page=$page_size*$i;
								// page_num = 1, 2, 3 .. 순
								$page_num=$i+1;
								// 현재 페이지는 굳이 a태그를 생성할 필요가 없으므로, $no와 $page가 다를 때만(현재 페이지가 아닌 다른 페이지 번호(ex -> 현재 1페이지라면, 1페이지 a태그는 비활성화, 2페이지부터 활성화) a태그 생성하는 로직
             							if($no!=$page){
									echo "<a href=list.php?no=$page>";
									}
								echo "$page_num ";
								if($no!=$page){
									echo "</a>";
								}
							}
						?>
                     </font>
                 </td>
	     </tr>
	 </table>
         <a href=write.php>글쓰기</a>
     </center>
 </body>
 </html>
