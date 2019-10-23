<html>
	<head>
		<title>CodeBox by Pluto0x0</title>
		<style>
		ul
		{
			position:absolute;
			left:50%;
			top:5%;
		}
		textarea
		{
			width:50%;
			height:100%;	
		}
		</style>
	</head>
	<body>
		<form action="save.php" method="POST" id="main">
			文件名：</br>
			<input name="filename" type=text style="width:150px;"/></br>
			<input type=submit>
		</form>
		代码：</br>
		<textarea name="code" form="main">//enter your code</textarea></br>
		<ul>
		<?php
		$dir = 'pool';
		if(is_dir($dir)){
			if($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					  if($file != '..' && $file != '.'){
							echo '<li><a href="pool/'.$file.'">'.$file.'</a></li>';
					  }
				}
				closedir($dh);
			}
		}
		else echo '<b>dir nedied.</b>';
		?>
		</ul>
	</body>
</html>