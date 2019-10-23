<?php
include 'config.php';

$id = $_POST['modifyid'];

$conn = mysqli_connect('localhost',$sql_user,$sql_passwd,$db_name);
if(mysqli_errno($conn)){
	echo mysqli_error($conn);
	exit;
}
mysqli_set_charset($conn, 'utf8');

$sql = "UPDATE main SET star=".$_POST['target']." WHERE id=".$id;
$result = mysqli_query($conn, $sql);

header('location: '.$self.'?page='.$_POST['page'].'&some='.$_POST['some'].'#'.$id);
?>