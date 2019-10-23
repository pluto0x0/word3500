<?php
include 'config.php';
if(isset($_GET['id'])){
	$conn = mysqli_connect('localhost',$sql_user,$sql_passwd,$db_name);
	if(mysqli_errno($conn)){
		echo mysqli_error($conn);
		exit('MySql Login denied');
	}
	mysqli_set_charset($conn, 'utf8');
	$sql = "UPDATE main SET star=".$_GET['target']." WHERE id=".$_GET['id'];
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
	if($result){
		exit('set id:'.$_GET['id'].' -> '.$_GET['target'].' successfully!');
	}
	exit('MySql denied');
}
else{
	exit('Please input id');
}
?>