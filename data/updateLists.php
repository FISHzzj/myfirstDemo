<?php
// data/updateLists.php
require("00_init.php");
$lid=$_REQUEST["lid"];
$price=$_REQUEST["price"];
$reg='/^\d{1,}(\.\d{1,2})?$/';
$re=preg_match($reg, $lid);
$rs=preg_match($reg, $price);
if(!$re)
	die('{"code":-1,"msg":"lid 参数有误"}');
if(!$rs)
	die('{"code":-1,"msg":"价格的格式有误"}');
$sql="update dz_laptop set price=$price where lid=$lid";
$result=mysqli_query($conn,$sql);
$rowCount=mysqli_affected_rows($conn);
if($rowCount>0)
	echo '{"code":1,"msg":"更新成功"}';
else
	echo '{"code":-1,"msg":"更新失败"}';
















?>