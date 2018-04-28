<?php
//data/deleteChecked.php
require("00_init.php");
$lid=$_REQUEST["lid"];
$reg='/^\d{1,}$/';
$re=preg_match($reg,$lid);
if(!$re)
	die('{"code":-1,"msg":"$lid的参数有误"}');
$sql="delete from dz_laptop where lid=$lid";
$result=mysqli_query($conn,$sql);
//判断条件 update,delete,insert
$rowCount=mysqli_affected_rows($conn);
if($rowCount>0){
	echo ('{"code":1,"msg":"删除成功"}');
}else
	echo ('{"code":-1,"msg":"删除失败"}');




















?>