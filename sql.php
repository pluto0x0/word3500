<?php
include 'config.php';
$conn = mysqli_connect('localhost',$sql_user,$sql_passwd,$db_name);
if(mysqli_errno($conn)){
	echo mysqli_error($conn);
	exit;
}

mysqli_set_charset($conn, 'utf8');
mysqli_query($conn, 'DROP TABLE IF EXISTS main;');
$sql = 'CREATE TABLE main(
id SMALLINT,
star TINYINT,
word VARCHAR('.$word_length.'),
pronunciation VARCHAR('.$word_length.'),
meaning VARCHAR('.$word_length.')
);';

$ress = mysqli_query($conn, $sql);

if($ress){
	echo 'success';
}
else {
	echo 'denied';
}

$totalwords = file_get_contents($filename);
$words = explode("\n",$totalwords);
$len = count($words) / 3;

for ($i = 0;$i < $len;$i++) {
	$sql = "INSERT INTO main(id,star,word,pronunciation,meaning) VALUES(".$i.",0";
	for ($j = 0;$j < 3;$j++){
		$sql .= ",'".trim($words[$i * 3 + $j])."'";
	}
	$sql .= ");";
	
	$ress = mysqli_query($conn, $sql);

	if($ress){
		echo $i.' '.$words[$i * 3].'success</br>';
	}
	else {
		echo $i.' '.$words[$i * 3].'denied</br>'.$sql.'</br>';
	}
	echo '</br>';
}

?>