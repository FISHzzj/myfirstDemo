<?php
require_once("00_init.php");
@$lid=$_REQUEST["lid"];
$reg='/^\d{1,}$/';
$rs=preg_match($reg, $lid);
if(!$rs)
	die('{"code":-1,"msg":"商品的id有误"}');
// echo $lid;
$sql=" select lid,lname,price,spec,disk,category,title from xz_laptop where lid=$lid ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($result,1);
echo json_encode($row);




















?>