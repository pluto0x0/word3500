function readword(word)
{
	console.log("readword:" + word);
	/*
	var res;
	var radio = document.getElementsByName("accent");
	for (i=0; i < radio.length; i++) {
		if (radio[i].checked) {
			res = radio[i].value;
		}
	}
	*/
	var audio = new Audio("https://dict.youdao.com/dictvoice?type=" + $('input:radio[name="accent"]:checked').val() + "&audio=" + word);
	var playPromise = audio.play();
	
	if(run){
		//now++;
		if(gonext()){
			audio.addEventListener('ended', function () {  
				setTimeout("zh()",1000);
			}, false);
		}
		else {
			run = false;
			document.getElementById("play").children[0].setAttribute("class", "fa fa-play"); //set button
			now = -1;
		}
	}
}
function setstar(id) {
	var star = document.getElementById("star" + id).children[0];
	var old_style = star.getAttribute("style");
	var target = star.getAttribute("class") == "fa fa-star" ? 0 : 1;
	var new_style = target == 1 ? old_style.replace("black", "red") : old_style.replace("red", "black");
	star.setAttribute("class", target == 1 ? "fa fa-star" : "fa fa-star-o");
	console.log(old_style + " to " + new_style);
	star.setAttribute("style", new_style);
	
	$.ajax({
		url:"api.php",
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

var run = false;
var now = -1;
var iterator;
//var beginid = 0;

function gopage(ass){
	window.location.href = document.getElementById(ass).getAttribute("href");
}
function clearCookie(name) {  
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
}
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}
function gonext(){
	iterator = iterator.nextElementSibling;
	if(iterator.nextElementSibling == null){
		if(getCookie("control") == "once" || getCookie("control") == null){
			console.log("stop reading!");
			return false;
		}
		if(getCookie("control") == "loop"){
			console.log("jump to head!");
			iterator = document.getElementById(beginid);
			now = beginid;
		}
		else{
			console.log("redy to jump to next page!");
			SetCookie("continue","");
			gopage("rpage");
		}
	}
	now = iterator.getAttribute("id");
	return true;
}
function getitem(line,col){
	return document.getElementById(line).children[col].innerHTML;
}
function SetCookie(name, value) {
    var exp = new Date();
    exp.setTime(exp.getTime() + 24 * 60 * 60 * 7000);//过期时间：7天
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
function zh(){
	var tmp = getitem(now,5);
	tmp = tmp.slice(tmp.lastIndexOf(".") + 1);
	console.log("reading zh : " + tmp);
	var audio = new Audio("https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&tex=" + tmp);
	if(run){
		var playPromise = audio.play();
		audio.addEventListener('ended', function () {
			setTimeout("readword('" + getitem(now,2) + "')",500);
		}, false);
	}
}
function listen(id){
	var button = document.getElementById("play").children[0];
	
	if(run){
		run = false;
		button.setAttribute("class", "fa fa-play");
		now = -1;
	}
	else{
		beginid = id;
		run = true;
		if(now == -1){
			now = id;
			iterator = document.getElementById(id);
		}
		zh();
		button.setAttribute("class", "fa fa-pause");
	}
}
function testfunc() {
	alert(beginid);
}
$(function(){
	$(":radio").click(function(){
		var name = $(this).attr('name'), val = $(this).val();
		console.log(name + "->" + val);
		SetCookie(name, val);
		if(name == "begin") {
			document.getElementById(val).setAttribute("bgcolor", "#98FB98");
		}
	});
});