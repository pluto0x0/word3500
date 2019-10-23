<title>高考英语词汇3500 - 搜索页面</title>
<link rel="icon" type="image/x-icon" href="img/logo_search.png" />

<?php
$search = $_GET['search'];
$pattern = $_GET['pattern'];
include 'config.php';
function target_url($id){
	include 'config.php';
	return $self.'?page='.(floor(($id - 1) / $interval) + 1).'&some=false#'.$id;
}
function jump($id){
	header('location:'.target_url($id));
}
if(is_numeric(trim($search))) {
	jump(intval($search));
}
else{
	$conn = mysqli_connect('localhost',$sql_user,$sql_passwd,$db_name);
	if(mysqli_errno($conn)){
		echo mysqli_error($conn);
		exit;
	}
	mysqli_set_charset($conn, 'utf8');
	
	if($pattern == 'contain') $tmp = "'%".$search."%'";
	else $tmp = $pattern == 'begin' ? "'".$search."%'" : "'%".$search."'";
	$sql = "SELECT id,word FROM main WHERE word LIKE ".$tmp;
	
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_all($result);
	
	if(count($data) == 0) {
		echo '<script>
		alert("No Such Word!");
		history.go(-1);
		</script>';
	}
	elseif(count($data) == 1){
		jump(intval($data[0][0]));
	}
	if($pattern == 'contain') echo '<h1>包含 "<font color="red">'.$search.'</font>" 的搜索结果</h1>';
	elseif($pattern == 'begin') echo '<h1>以 "<font color="red">'.$search.'</font>" 开头的搜索结果</h1>';
	else echo '<h1>以 "<font color="red">'.$search.'</font>" 结尾的搜索结果</h1>';
	for($i = 0;$i < count($data);$i++){
		echo '<a href="'.target_url($data[$i][0]).'"><font size="6">'.$data[$i][1].'</font></a></br>';
	}
	//echo $data[0];
	//echo $sql;
	//jump(intval($data['id']));
}
?>