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

<script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>

<script>
function setstar(id)
{
	var star = document.getElementById("star" + id).children[0];
	console.log(star.getAttribute("class"));
	var old_style = star.getAttribute("style");
	var target = star.getAttribute("class") == "fa fa-star" ? 0 : 1;
	var new_style = target == 1 ? old_style.replace("black", "red") : old_style.replace("red", "black");
	star.setAttribute("class", target == 1 ? "fa fa-star" : "fa fa-star-o");
	console.log(old_style + " to " + new_style);
	star.setAttribute("style", new_style);
	$.ajax({
		url:"tmp.php",
		data:{
			id: id,
			target: target
		},
		type:"GET",
		success:function(re){
			console.log(re);
		}
	});
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
			$star = ($val == 0) ? '<i class="fa fa-star-o" style="font-size:'.$width.'px; color:black;"></i>' : '<i class="fa fa-star" style="font-size:'.$width.'px;  color:red;"></i>';
			echo '<button '.SAFARI.' onclick="setstar('.$i.')" id="star'.$i.'">'.$star.'</button>'; 
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
echo '<a href="#top"><i class="fa fa-chevron-up"></i></a>'.SPACE;
if($page > 1)
	echo '<a href="'.$self.'?page='.($page-1).'&some='.$some.'"><i class="fa fa-arrow-left"></i></a>'.SPACE;
if($page * $interval < $len)
	echo '<a href="'.$self.'?page='.($page+1).'&some='.$some.'"><i class="fa fa-arrow-right"></i></a>'.SPACE;

echo '<input type="radio" name="accent" value="1" checked="checked"><image src="gb.png"></input>';
echo '&nbsp;&nbsp;';
echo '<input type="radio" name="accent" value="0"><image src="us.png"></input>';

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


echo '&copy; '.date('Y').' By Pluto0x0. All rights reserved.</br>'.
	 '<a href="https://pluto0x0.xyz"><i class="fa fa-user-circle"></i></a>'.SPACE.
	 '<a href="mailto:ying.zf@foxmail.com"><i class="fa fa-envelope"></i></a>'.SPACE.
	 '<a href="http://wpa.qq.com/msgrd?v=3&uin=1131234847&site=qq&menu=yes"><i class="fa fa-qq"></i></a>'.SPACE.
	 '<a href="https://github.com/pluto0x0"><i class="fa fa-github"></i></a>'.SPACE.
	 '<a href="https://weibo.com/u/6008538011"><i class="fa fa-weibo"></i></a>';
echo '</center>';
?>