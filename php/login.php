<?php
require("init.php");
$aname=$_REQUEST["aname"];
$apwd=$_REQUEST["apwd"];
$yzm=$_REQUEST["yzm"];
$phpyzm=$SESSION["code"];
if($yzm==$phpyzm){
	die('{"code":-1,"msg":"验证码有误"}');
}
$reg='/^\w{1,12}$/';
$re=preg_match($reg, $apwd);
if(!$re)
	die('{"code":-1,"msg":"密码参数	有误"}');
echo $re;



?>