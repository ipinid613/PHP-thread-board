<?php
        session_start();
	include "/var/www/html/db_info.php";
        $id=$_GET['id'];

	$thread_result=mysqli_query($conn, "select thread,depth from $board where id=$id");
	$thread_fetch=mysqli_fetch_array($thread_result);

	$userid=$_POST['userid'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$title=$_POST['title'];
	$content=$_POST['content'];
	// 'thread'는 새글 작성 시 1000단위로 어센딩하도록 설정했음.
	// 따라서 답글을 생성할 경우에는 새글을 작성하는 것이 아니므로 thread를 1000단위 어센딩 하면 안 됨.
	// 게시글 목록(list.php)에서 레코드를 thread순으로 정렬하도록 불러오므로, 답글의 thread는 원글 thread-100으로 하면
	// 게시글 목록에서 알맞은 순서로 배치될 것임.
	$max_thread=$thread_fetch['thread']-100;
	// 새글의 경우 depth는 0이지만, 답글이 생성될 때는 depth+1을 해주어 위계를 설정해줌.
	// 설정된 위계(depth)를 게시글 목록(list.php)에서는 indent 또는 별도의 img삽입하여 구분해줌.
	$dapth=$thread_fetch['depth'];
        $dapth2=$dapth+1;

	$query="insert into $board(thread,depth,userid,password,email,title,see,wdate,content) values('$max_thread','$dapth2','$userid','$password','$email','$title',0,now(),'$content')";
	$result=mysqli_query($conn, $query);
	mysqli_close($conn);
	echo "<meta http-equiv='refresh' content='1; URL=list.php?no=0'>";
?>
