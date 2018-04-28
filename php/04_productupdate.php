<?php
require_once("00_init.php");
@$lid=$_REQUEST["lid"];
@$price=$_REQUEST["price"];
// echo $lid;
// echo $price;
if($lid!==null&&$price!==null)
// echo $price;
// echo $lid;	
// $regl='/^\d{1,}$/';
// $reg='/^\d{1,}(\.\d{1,2})?$/';
// $lr=preg_match($regp, $lid);
// $pr=preg_match($reg, $price);
// echo $pr;
// if(!$lr)
// 	die('{"code":-1,"msg":"商品编号有误"}');
// if(!$pr)
// 	die('{"code":-1},"msg":"商品价格有误"');

// 加单双引号原因：当前列varchar 类型
// sql语句最基本优化手段：类型匹配；
// name="Tom";
// price=19.99;
$sql=" update xz_laptop set price=$price where lid=$lid ";
$result=mysqli_query($conn,$sql);
// echo $result;
$rowCount=mysqli_affected_rows($conn);
// echo $rowCount;
if($rowCount>0)
	echo '{"code":1,"msg":"更新成功"}';  //这里要写json格式，否则在前端接收的时候回报错
else
	echo '{"code":-1,"msg":"更新失败"}';

















?>