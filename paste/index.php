<?php header("Content-Type: text/html;charset=utf-8");?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<title>CodeBox by Pluto0x0<?php if(isset($_GET['filename'])) echo ' - '.$_GET['filename'];?></title>
		<style>
		@font-face
		{
			font-family:"Billabong";
			src:url("font/Billabong.ttf") format('truetype');
　　	}
		.logo,.des
		{
			text-shadow:2px 2px 8px #606060;
			font-family:"Billabong";
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.logo
		{
			font-size:55px;
		}
		.des
		{
			font-size:30px;
		}
		.hd
		{
			position:relative;
			left:20%;
		}
		#dii
		{
			position:relative;
			left:5%;
			width:45%;
		}
		ul{ border-radius:25px; }
		textarea,.filename{ border-radius:10px; }
		ul,textarea,input{ box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); }
		ul
		{
			position:absolute;
			left:53%;
			top:5%;
			font-size:24px;
			line-height:40px;
			word-wrap:break-word; 
			word-break:break-all;
		}
		textarea
		{
			width:100%;
			min-width:50%;
			max-width:120%;
			height:92%;
			min-height:30%;
			font-size:22px;
			font-family:"yahei";
		}
		.go,.del,.edit{text-decoration:none;}
		.go:link {color:Black;}
		.go:visited {color:Gray;}  
		.go:hover {color:DeepSkyBlue;/* font-size:28px;*/}  
		.go:active {color:SpringGreen;/* font-size:22px;*/}  
		.del:link {color:Gray;/* font-size:16px;*/}
		.del:hover {color:Red;/* font-size:22px;*/}  
		.del:active {color:DarkRed;/* font-size:14px;*/}  
		
		.edit:link {color:Black;/* font-size:16px;*/}     
		.edit:visited {color:Gray;}  
		.edit:hover {color:Green;/* font-size:22px;*/}  
		.edit:active {color:Lime;/* font-size:14px;*/}  
		
		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			top:-30%;
			left:-70px;
			min-width: 70px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		}

		.dropdown-content a {
			color: black;
			padding: 4px 5px;
			text-decoration: none;
			display: block;
			right: 0;
		}

		.dropdown-content a:hover {background-color: #f1f1f1;}

		.dropdown:hover .dropdown-content {
			display: block;
		}
		</style>
	</head>
	<body>
		<div class="hd">
		<span class="logo">CodeBox&nbsp;&nbsp;&nbsp;</span><span class="des">powered by Pluto0x0</span>
		</div>
		<div id="dii">
		<form action="save.php" method="POST" id="main">
			文件名：<br/>
			<input class="filename" name="filename" type=text style="width:150px;" <?php if(isset($_GET['filename'])) echo 'value="'.$_GET['filename'].'"'?>/>&nbsp;
			<input type=submit>
		</form>
		<?php if(isset($_GET['filename'])):?>
			<a href=".">退出编辑</a><br/>
		<?php endif;?>
		代码：<br/>
		<textarea name="code" form="main" placeholder="//enter your code"><?php if(isset($_GET['filename'])) echo file_get_contents('pool/'.$_GET['filename']);?></textarea><br/>
		</div>
		<ul>
		<?php
		$dir = 'pool';
		if(is_dir($dir)){
			if($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					  if($file != '..' && $file != '.'){?>
						<li>
							<div class="dropdown">
								<a class="go dropdown" href="display.php?filename=<?php echo $file;?>"><?php echo $file;?></a> &nbsp;&nbsp;
								<div class="dropdown-content">
									<a class="edit" href="?filename=<?php echo $file;?>">编辑</a>
									<a class="del" href="display.php?filename=<?php echo $file;?>&action=delete">删除</a>
								</div>
							</div>
							<div></div>
						</li>
					  <?php }
				}
				closedir($dh);
			}
		}
		else echo '<b>dir nedied.</b>';
		?>
		</ul>
	</body>
</html>