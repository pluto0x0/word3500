<?php
header("Content-Type: text/html;charset=utf-8");
if(!isset($_GET['filename'])) die('请输入文件名！');
if(strpos($_GET['filename'],'/') != false) header('Location:index.php');
if($_GET['action'] == 'delete'){
	unlink('pool/'.$_GET['filename']);
	header('Location:index.php');
}
?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<title>Code View - <?php echo $_GET['filename'];?></title>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/styles/default.min.css"/>
		<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.15.10/build/highlight.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
		<script>
		hljs.configure({
			tabReplace: '    '
		})
		hljs.initHighlightingOnLoad();
		</script>
		<style>
		code
		{
			border-radius:10px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.4);
			position:absolute;
			left:5%;
			top:5%;
		}
		button{ box-shadow: -10px 10px 16px 4px rgba(0,0,0,0.3); }
		@font-face
		{
			font-family:"Consola";
			src:url("font/consola.ttf") format('truetype');
　　	}
		code
		{
			font-family:"Consola";
			font-size:20px;
		}
		#copy
		{
			position:fixed;
			top:30px;
			right:15px;
		}
		#home
		{
			position:fixed;
			top:94px;
			right:15px;
		}
		footer
		{
			align:center;
		}
		</style>
	</head>
	<body>
		<script>new ClipboardJS('.copy');</script>
		<pre>
			<code id="code"><?php
$file = file_get_contents('pool/'.$_GET['filename']) or header('Location:index.php');
$file = str_replace('<','&lt;',$file);
$file = str_replace('>','&gt;',$file);
echo $file;
?></code>
<button id="copy" class="copy" data-clipboard-target="#code"><img src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjEwMjQiIHdpZHRoPSI4OTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEyOCA3NjhoMjU2djY0SDEyOHYtNjR6IG0zMjAtMzg0SDEyOHY2NGgzMjB2LTY0eiBtMTI4IDE5MlY0NDhMMzg0IDY0MGwxOTIgMTkyVjcwNGgzMjBWNTc2SDU3NnogbS0yODgtNjRIMTI4djY0aDE2MHYtNjR6TTEyOCA3MDRoMTYwdi02NEgxMjh2NjR6IG01NzYgNjRoNjR2MTI4Yy0xIDE4LTcgMzMtMTkgNDVzLTI3IDE4LTQ1IDE5SDY0Yy0zNSAwLTY0LTI5LTY0LTY0VjE5MmMwLTM1IDI5LTY0IDY0LTY0aDE5MkMyNTYgNTcgMzEzIDAgMzg0IDBzMTI4IDU3IDEyOCAxMjhoMTkyYzM1IDAgNjQgMjkgNjQgNjR2MzIwaC02NFYzMjBINjR2NTc2aDY0MFY3Njh6TTEyOCAyNTZoNTEyYzAtMzUtMjktNjQtNjQtNjRoLTY0Yy0zNSAwLTY0LTI5LTY0LTY0cy0yOS02NC02NC02NC02NCAyOS02NCA2NC0yOSA2NC02NCA2NGgtNjRjLTM1IDAtNjQgMjktNjQgNjR6IiAvPjwvc3ZnPg=="
width="42"
alt="Copy to clipboard"></button>
<button id="home" onclick="window.location.href='./'"><img src="data:image/svg+xml;base64,CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTIwIDcuMDkzdi01LjA5M2gtM3YyLjA5M2wzIDN6bTQgNS45MDdsLTEyLTEyLTEyIDEyaDN2MTBoN3YtNWg0djVoN3YtMTBoM3ptLTUgOGgtM3YtNWgtOHY1aC0zdi0xMC4yNmw3LTYuOTEyIDcgNi45OXYxMC4xODJ6Ii8+PC9zdmc+"
width="42"
alt="Back to home"></button>
		</pre>
	</body>
</html>