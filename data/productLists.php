<?php
// data/productLists.php
require("00_init.php");
@$pno=$_REQUEST["pno"];  //当前的页码，默认为0
@$pageSize=$_REQUEST["pageSize"];  //每页的商品数量  默认为8
// $pageCount     parseInt($pno/$pageSize)
if($pno==null)
	$pno=1;
if($pageSize==null)
	$pageSize=8;
$reg='/^\d{1,}$/';
$re=preg_match($reg,$pno);
if(!$re)
	die('{"code":-1,"msg":"页码数有误"}');
$rs=preg_match($reg,$pageSize);
if(!$rs)
	die('{"code":-1,"msg":"每页的商品数量有误"}');
$sql="select count(lid) from dz_laptop";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$pageCount=ceil($row[0]/$pageSize);
$offset=($pno-1)*$pageSize;
$sql="select lid,spec,title,disk,price,(select sm from dz_laptop_pic where laptop_id=lid limit 1) as sm from dz_laptop limit $offset,$pageSize";
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,1);
$plists=[
	"pno"=>$pno,
	"pageSize"=>$pageSize,
	"pageCount"=>$pageCount,
	"products"=>$rows,
];
echo json_encode($plists);
?>