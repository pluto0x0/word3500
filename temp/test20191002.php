<html>
<head>
	<title>高考英语词汇3500</title>
	<link rel="icon" type="image/x-icon" href="img/logo.png" />
	<link rel = "bookmark" type = "image/x-icon" href = "img/logo.png" />
	<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
	<script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
</head>
<body>
<?php
$time_start = microtime();
header("Content-Type: text/html;charset=utf-8");

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
		<th>选择</th>
		<th>中文解释</th>
		<th>朗读</th>
	</tr>';

$len = 3873;
$iter = -1;
for ($i = ($page - 1) * $interval + 1;$i < $len && $i <= $page * $interval;$i++) {
	//一行
	$sql = "SELECT * FROM main WHERE id=".$i;
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
	if($some == 'false' or $data['star'] == 1){
		if(!isset($first)) $first = $i;
		if($iter == -1 && $i == $_COOKIE['begin']) $iter = $i;
		echo '<tr id="'.$i.'" '.($_COOKIE['begin'] == $i ? 'bgcolor="#98FB98"' : '').'>';
		foreach($data as $key => $val){
			echo '<td>';
			if($key == 'star') {
				$star = ($val == 0) ? '<i class="fa fa-star-o" style="font-size:'.$width.'px; color:black;"></i>' :
									  '<i class="fa fa-star" style="font-size:'.$width.'px; color:red;"></i>';
				echo '<button '.SAFARI.' onclick="setstar('.$i.')" id="star'.$i.'">'.$star.'</button>'; 
			}
			else { echo $val; }
			echo '</td>';
			if($key == 'pronunciation') {
				echo '<td><input type="radio" name="begin" value="'.$i.'" '.($_COOKIE['begin'] == $i ? 'checked="checked"' : '').'></td>';
			}
		}
		echo '<td height="20px" '.MID.'>
			<button '.SAFARI.' onclick ="readword(\''.trim($data['word']).'\')">
			<i class="fa fa-volume-up" style="font-size:'.$width.'px;"></i>
			</button>
			</td>';
		echo '</td>';
	}
}
if($iter == -1) $iter = $first;

echo '<tr><td colspan="7">';

echo '<b>第'.$page.'页</b>'.SPACE;
echo '<a href="?page=1"><i class="fa fa-home"></i></a>'.SPACE;
echo '<a href="#top"><i class="fa fa-chevron-up"></i></a>'.SPACE;
if($page > 1)
	echo '<a href="?page='.($page-1).'&some='.$some.'" id="lpage"><i class="fa fa-arrow-left"></i></a>'.SPACE;
if($page * $interval < $len)
	echo '<a href="?page='.($page+1).'&some='.$some.'" id="rpage"><i class="fa fa-arrow-right"></i></a>'.SPACE;

$is_gb = $is_us = "";
if(!isset($_COOKIE['accent']) || $_COOKIE['accent'] == 'gb') $is_gb = 'checked="checked"';
else $is_us = 'checked="checked"';

echo '<input type="radio" name="accent" value="1" '.$is_gb.'><image src="img/gb.png" align ="middle"/>';
echo '&nbsp;&nbsp;';
echo '<input type="radio" name="accent" value="0" '.$is_us.'><image src="img/us.png" align ="middle"/>'.SPACE;

if($some == 'true'){
	echo '<a href = "?page='.$page.'&some=false"><i class="fa fa-eye" style="font-size:'.$width.'px;"></i></a>';
}
else{
	echo '<a href = "?page='.$page.'&some=true"><i class="fa fa-eye-slash" style="font-size:'.$width.'px;"></i></a>';
} 

echo '<form action="search.php" method="get">
	<font size="4">查询编号/单词:</font>
	<select name="pattern">
		<option value="contain">包含…</option>
		<option value="begin">以…开头</option>
		<option value="end">以…结尾</option>
	</select>
	<input type="text" name="search">
	<button><i class="fa fa-search" style="font-size:15px;"></i></button>
	</form>';
	
if(isset($first)) echo '<button onclick="listen()" id="play"><i class="fa fa-play" style="font-size:'.$width.'px;"></i></button>
	<input type="radio" name="control" value="once" '.(!isset($_COOKIE['control']) || $_COOKIE['control'] == 'once' ? 'checked="checked"' : '').'> 一遍
	<input type="radio" name="control" value="loop" '.($_COOKIE['control'] == 'loop' ? 'checked="checked"' : '').'> 循环
	<input type="radio" name="control" value="goon" '.($_COOKIE['control'] == 'goon' ? 'checked="checked"' : '').'> 顺序';

echo '</tr>';
echo '</table>';

echo '&copy; '.date('Y').' By Pluto0x0. All rights reserved.</br>'.
	 '<a href="https://pluto0x0.xyz"><i class="fa fa-globe" style="font-size:20px;"></i></a>'.SPACE.SPACE.
	 '<a href="mailto:ying.zf@foxmail.com"><i class="fa fa-envelope" style="font-size:20px;"></i></a>'.SPACE.SPACE.
	 '<a href="http://wpa.qq.com/msgrd?v=3&uin=1131234847&site=qq&menu=yes"><i class="fa fa-qq" style="font-size:20px;"></i></a>'.SPACE.SPACE.
	 '<a href="https://github.com/pluto0x0"><i class="fa fa-github" style="font-size:20px;"></i></a>'.SPACE.SPACE.
	 '<a href="https://weibo.com/u/6008538011"><i class="fa fa-weibo" style="font-size:20px;"></i></a>';
echo '</center>';

echo '<script>var beginid = "'.$iter.'";
var iterator = document.getElementById(beginid);
</script>';		//设置当前单词id和上一个单词id
if(isset($_COOKIE['continue']) && isset($first))
	echo '<script>
$(window).load(function (){
	clearCookie("continue");
	listen('.$first.');
});
</script>';

$time_end = microtime();
$loadtime = $time_end - $time_start;
echo '<center>php加载用时'.round($loadtime,6).'秒</center>';
echo '<center id="loadtime"></center>';
?>
<script src="js/main.js"></script>
<button onclick="testfunc()">haha</button>
</body>
</html>