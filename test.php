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
?>
<center>
<table border="1" style="font-size:<?php echo $font_size;?>px;" cellpadding="<?php echo $cellpadding;?>">
	<tr> 
		<th>编号</th>
		<th>标记</th>
		<th>单词</th>
		<th>发音</th>
		<th>选择</th>
		<th>中文解释</th>
		<th>朗读</th>
	</tr>
<?php
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
?>
<tr><td colspan="7">

<b>第<?php echo $page;?>页</b>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?page=1"><i class="fa fa-home"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#top"><i class="fa fa-chevron-up"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($page > 1): ?>
<a href="?page=<?php echo $page-1;?>&some=<?php echo $some;?>" id="lpage"><i class="fa fa-arrow-left"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif;?>
<?php if($page * $interval < $len): ?>
<a href="?page=<?php echo $page+1;?>&some=<?php echo $some;?>" id="rpage"><i class="fa fa-arrow-right"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif;?>
<?php
$is_gb = $is_us = "";
if(!isset($_COOKIE['accent']) || $_COOKIE['accent'] == 'gb') $is_gb = 'checked="checked"';
else $is_us = 'checked="checked"';
?>
<input type="radio" name="accent" value="1" <?php echo $is_gb;?>><image src="img/gb.png" align ="middle"/>&nbsp;&nbsp;
<input type="radio" name="accent" value="0" <?php echo $is_us;?>><image src="img/us.png" align ="middle"/>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if($some == 'true'): ?>
<a href = "?page=<?php echo $page;?>&some=false"><i class="fa fa-eye" style="font-size:<?php echo $width;?>px;"></i></a>
<?php else:?>
<a href = "?page=<?php echo $page;?>&some=true"><i class="fa fa-eye-slash" style="font-size:<?php echo $width;?>px;"></i></a>
<?php endif;?>

<form action="search.php" method="get">
<font size="4">查询编号/单词:</font>
<select name="pattern">
	<option value="contain">包含…</option>
	<option value="begin">以…开头</option>
	<option value="end">以…结尾</option>
</select>
<input type="text" name="search">
<button><i class="fa fa-search" style="font-size:15px;"></i></button>
</form>
	
<?php if(isset($first)): ?>
	<button onclick="listen()" id="play"><i class="fa fa-play" style="font-size:<?php echo $width;?>px;"></i></button>
	<input type="radio" name="control" value="once" <?php if(!isset($_COOKIE['control']) || $_COOKIE['control'] == 'once') echo 'checked="checked"';?> > 一遍
	<input type="radio" name="control" value="loop" <?php if($_COOKIE['control'] == 'loop') echo 'checked="checked"';?> > 循环
	<input type="radio" name="control" value="goon" <?php if($_COOKIE['control'] == 'goon') echo 'checked="checked"';?> > 顺序
<?php endif;?>

</tr>
</table>

&copy; <?php echo date('Y');?> By Pluto0x0. All rights reserved.</br>
 <a href="https://pluto0x0.xyz"><i class="fa fa-globe" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="mailto:ying.zf@foxmail.com"><i class="fa fa-envelope" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="http://wpa.qq.com/msgrd?v=3&uin=1131234847&site=qq&menu=yes"><i class="fa fa-qq" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="https://github.com/pluto0x0"><i class="fa fa-github" style="font-size:20px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="https://github.com/pluto0x0/word3500/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/pluto0x0/word3500"></a>&nbsp;&nbsp;&nbsp;&nbsp;
 <a href="https://weibo.com/u/6008538011"><i class="fa fa-weibo" style="font-size:20px;"></i></a>
</center>

<script>
var beginid = "<?php echo $iter;?>";
var iterator = document.getElementById(beginid);
</script>
<?php if(isset($_COOKIE['continue']) && isset($first)): ?>
<script>
$(window).load(function (){
	clearCookie("continue");
	listen('.$first.');
});
</script><?php endif;?>
<?php $time_end = microtime(); $loadtime = $time_end - $time_start; ?>
<center>php加载用时<?php echo round($loadtime,6);?>秒</center>
<center id="loadtime"></center>
<script src="js/main.js"></script>
<button onclick="testfunc()">haha</button>
</body>
</html>