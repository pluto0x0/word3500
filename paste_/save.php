<?php
var_dump($_POST);
if($_POST['filename'] == '') die('文件名为空！');
if($_POST['code'] == '') die('代码为空！');
$file = fopen('pool/'.$_POST['filename'], 'w');
if($file == false) die('无法打开文件');
fwrite($file, $_POST['code']);
fclose($file);
?> 