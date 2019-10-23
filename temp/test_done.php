<title>高考英语词汇3500</title>

<link rel="icon" type="image/x-icon" href="logo.png" />
<link rel = "bookmark" type = "image/x-icon" href = "logo.png" />
<link rel="shortcut icon" href="logo.png">

<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">

<script>
function readword(word)
{
	
	var res;
	var radio = document.getElementsByName("accent");
	for (i=0; i < radio.length; i++) {
		if (radio[i].checked) {
			res = radio[i].value;
		}
	}
	
	new Audio("https://dict.youdao.com/dictvoice?type=" + res + "&audio=" + word).play();
}
</script>

<?php

include 'config.php';
/*------------MySQL------------*/
$conn = mysqli_connect('localhost',$sql_user,$sql_passwd,$db_name);
if(mysqli_errno($conn)){
	echo mysqli_error($conn);
	exit;
}
mysqli_set_charset($conn, 'utf8');
/*-----------------------------*/

if(isset($_POST['modityid'])) {
	$id = $_POST['modityid'];
	$sql = '';
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$some = isset($_GET['some']) ? $_GET['some'] : 'false';

echo '<center>';
    
echo '<table border="1" style="font-size:'.$font_size.'px;" cellpadding="'.$cellpadding.'">
	<tr> 
		<th>编号</th>
		<th>star</th>
		<th>单词</th>
		<th>发音</th>
		<th>中文解释</th>
		<th>朗读</th>
	</tr>';

$len = 3873;
for ($i = ($page - 1) * $interval + 1;$i < $len && $i <= $page * $interval;$i++) {
	//一行
	$sql = "SELECT * FROM main WHERE id=".$i;
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
if($some == 'false' or $data['star'] == 1){
	echo '<tr id="'.$i.'">';
	foreach($data as $key => $val){
		echo '<td >'; ////////////////////////////////
		if($key == 'star') {
			$star = ($val == 0) ? '<i class="fa fa-star-o" style="font-size:'.$width.'px;"></i>' : '<i class="fa fa-star" style="font-size:'.$width.'px;  color:red;"></i>';
			echo '<form action="ass.php" method="post">
				<button>'.$star.'</button>
				<input type="hidden" name="modifyid" value="'.$i.'" />
				<input type="hidden" name="page" value="'.$page.'" />
				<input type="hidden" name="some" value="'.$some.'" />
				<input type="hidden" name="target" value="'.(1 - $val).'" />
				</form>'; 
		}
		else {
			echo $val;
		}
		echo '<br/>';
	}
	echo '<td>
		<button onclick ="readword(\''.trim($data['word']).'\')">
		<i class="fa fa-volume-up" style="font-size:'.$width.'px;"></i>
		</button>
		<br/>';
	echo '</tr>';
}
}

echo '<tr><td colspan="5">';

echo '<b>第'.$page.'页</b>&nbsp;&nbsp;&nbsp;';
echo '<a href="'.$self.'?page=1"><i class="fa fa-home"></i></a>&nbsp;&nbsp;&nbsp;';
echo '<a href="#top"><i class="fa fa-arrow-up"></i></a>&nbsp;&nbsp;&nbsp;';
if($page > 1)
	echo '<a href="'.$self.'?page='.($page-1).'"><i class="fa fa-arrow-left"></i></a>&nbsp;&nbsp;&nbsp;';
if($page * $interval < $len)
	echo '<a href="'.$self.'?page='.($page+1).'"><i class="fa fa-arrow-right"></i></a>&nbsp;&nbsp;&nbsp;';

echo '<input type="radio" name="accent" value="1" checked="checked">英音';
echo '<input type="radio" name="accent" value="0">美音';

if($some == 'true'){
	echo '<a href = "'.$self.'?page='.$page.'&some=false">not some</a>';
}
else{
	echo '<a href = "'.$self.'?page='.$page.'&some=true">some</a>';
}
echo '</tr>';

echo '</table>';

echo '</center>';
?>