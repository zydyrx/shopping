<?php
header('countent-type:text/html;charset=utf-8');
echo '<mete http-equiv="Content-Type" content="text/html;charset=utf-8" />';
$showmsg='';
$filename='file/msg.txt';
if(isset($_POST['msg'])){
	setmsg($filename, $_POST);
	flush();
	header('refresh:1;url=msg.php');
	echo "<script>alert('添加成功');</sctipt>";
	$showmsg=getmsg('file/msg.txt');
}else{
	$showmsg=getmsg('file/msg.txt');
}

function getmsg($fileurl){
	$remsg='';
	if(filesize($fileurl)>0){
		$memo=file_get_contents($fileurl);
		$msgarr=explode('|', $memo);
		if(count($msgarr)>1){
			foreach($msgarr as $key=>$val){
				$remsg.='<p>'.$val.'<span class=del><a href="delmsg.php?id='.$key.'">删除</a></span></p>';
			}
		}else{
			$remsg=$msgarr[0];
		}
	}else{
		$remsg='';
	}
	return $remsg;
}


function setmsg($fileurl,$msg){
	$memo='';
	if(filesize($fileurl)>0){
		$memo=file_get_contents($fileurl);
		$memo.='|'.$msg;
	}else{
		$memo=$msg;
	}
	file_put_contents($fileurl, $memo);
}
?>

<html>
	<body>
		<?php getmsg($filename) ?>
		<form action="msg.php?name=sca" method="post">
			<textarea name="sca"></textarea>
			<input type="submit" value="提交"/>
		</form>
	</body>
</html>