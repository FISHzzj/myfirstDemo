<?php
session_start();
require("00_init.php");
@$aname=$_REQUEST["aname"];
@$apwd=$_REQUEST["apwd"];
@$yzm=$_REQUEST["yzm"];
@$phpyzm=$_SESSION["code"];
if($yzm!==$phpyzm){
	die('{"key":-1,"msg":"验证码有误"}');
}
$reg='/^\w{1,12}$/';
$re=preg_match($reg, $apwd);
if(!$re)
	die('{"code":-1,"msg":"密码参数有误"}');
$sql="select aid from xz_admin where aname='$aname' and apwd=md5('$apwd')";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row==null)
	echo '{"code":-1,"msg":"用户名或密码有误，请从新输入"}';
else
	echo '{"code":1,"msg":"登录成功"}';


?>