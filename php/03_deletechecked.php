<?php
require("00_init.php");
@$lid=$_REQUEST["lid"];
$reg='/^\d{1,}$/';
$re=preg_match($reg,$lid);
if(!$re)
	die('{"ok":-1,"code":"lid有误，请重新输入"}');
$sql="delete from xz_laptop where lid=$lid ";
$result=mysqli_query($conn,$sql);
// 判断条件（update/delete/insert）
$rowCount=mysqli_affected_rows($conn);  //这里也容易忘记
// echo $rowCount;
if($rowCount>0)   
	echo '{"code":1,"msg":"删除成功"}';
else
	echo '{"code":-1,"msg":"删除失败"}'










?>