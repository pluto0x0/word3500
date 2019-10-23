<?php
header("Content-Type: text/html;charset=utf-8");
if($_POST['filename'] == '') die('文件名为空！<a href="./">BACK HOME</a>');
if($_POST['code'] == '') die('代码为空！ <a href="./">BACK HOME</a>');
$file = fopen('pool/'.str_replace('/','_',$_POST['filename']), 'w');
if($file == false) die('无法打开文件 <a href="./">BACK HOME</a>');
fwrite($file, $_POST['code']);
fclose($file);
header('Location:./');
?> 