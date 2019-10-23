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
include 'ua.php';

define('SPACE','&nbsp;&nbsp;&nbsp;&nbsp;');
define('SAFARI',GetBrowser() == "Safari" ? 'style="-webkit-appearance:none"' : '');
define('MID','valign="middle"');

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
		<th>标记</th>
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
		echo '<td height="20px" '.MID.'>'; ////////////////////////////////
		if($key == 'star') {
			$star = ($val == 0) ? '<i class="fa fa-star-o" style="font-size:'.$width.'px;"></i>' : '<i class="fa fa-star" style="font-size:'.$width.'px;  color:red;"></i>';
			echo '<form action="ass.php" method="post">
				<button '.SAFARI.'>'.$star.'</button>
				<input type="hidden" name="modifyid" value="'.$i.'" />
				<input type="hidden" name="page" value="'.$page.'" />
				<input type="hidden" name="some" value="'.$some.'" />
				<input type="hidden" name="target" value="'.(1 - $val).'" />
				</form>'; 
		}
		else {
			echo $val;
		}
		echo '</td>';
	}
	echo '<td height="20px" '.MID.'>
		<button '.SAFARI.' onclick ="readword(\''.trim($data['word']).'\')">
		<i class="fa fa-volume-up" style="font-size:'.$width.'px;"></i>
		</button>
		</td>';
	echo '</td>';
}
}

echo '<tr><td colspan="6">';

echo '<b>第'.$page.'页</b>'.SPACE;
echo '<a href="'.$self.'?page=1"><i class="fa fa-home"></i></a>'.SPACE;
echo '<a href="#top"><i class="fa fa-arrow-up"></i></a>'.SPACE;
if($page > 1)
	echo '<a href="'.$self.'?page='.($page-1).'&some='.$some.'"><i class="fa fa-arrow-left"></i></a>'.SPACE;
if($page * $interval < $len)
	echo '<a href="'.$self.'?page='.($page+1).'&some='.$some.'"><i class="fa fa-arrow-right"></i></a>'.SPACE;

echo '<input type="radio" name="accent" value="1" checked="checked"><image src="gb.png">';
echo '&nbsp;&nbsp;';
echo '<input type="radio" name="accent" value="0"><image src="us.png">';

if($some == 'true'){
	echo '<a href = "'.$self.'?page='.$page.'&some=false">
		<i class="fa fa-eye" style="font-size:'.$width.'px;">
		</a>';
}
else{
	echo SPACE.'<a href = "'.$self.'?page='.$page.'&some=true">
	<i class="fa fa-eye-slash" style="font-size:'.$width.'px;">
	</a>';
}
echo '</tr>';

echo '</table>';

echo '</center>';
?>