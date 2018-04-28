<?php
require_once("00_init.php");
@$kw=$_REQUEST["kw"]; //Apple MacBook 银色
@$priceUp=$_REQUEST["priceUp"];
@$priceDown=$_REQUEST["priceDown"];
@$pno=$_REQUEST["pno"];
@$pageSize=$_REQUEST["pageSize"];
if(!$kw)
	$kw="";
if(!$pno)
	$pno=1;
if(!$priceUp)
	$priceUp=1;
if(!$priceDown)
	$priceDown=2100000000;
if(!$pageSize)
	$pageSize=8;
$reg='/^\d{1,}(\.\d{1,2})?$/';
$rs=preg_match($reg, $pno);
if(!$rs)
	die('{"code":-1,"msg":"当前页的页码有误"}');
$rs=preg_match($reg,$priceUp);
if(!$rs)
	die('{"code":-1,"msg":"上限参数有误"}');
$rs=preg_match($reg, $priceDown);
if(!$rs)
	die('{"code":-1,"msg":"下限参数有误"}');
$rs=preg_match($reg, $pageSize);
if(!$rs)
	die('{"code":-1,"msg":"每页商品数量参数有误"}');
$sql=" select count(lid) from xz_laptop ";
$result=mysqli_query($conn,$sql);
$rowCount=mysqli_fetch_all($result,1);
$rowCount=$rowCount[0]["count(lid)"];
$pageCount=ceil($rowCount/$pageSize);
$offset=$pageSize*$pno;
$sql=" select lid,title,lname,price,spec from xz_laptop ";
$sql.=" where price>=$priceUp ";
$sql.=" and price<=$priceDown ";
$sql.=" and lname like '%$kw%' ";
$sql.=" limit $offset,$pageSize ";
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($result,1);
// echo json_encode($rows);
$output=[
	"pno"=>$pno,		//当前第几页  从1开始
	"pageSize"=>8,		//每页商品数量
	"pageCount"=>$pageCount,  	// 总页数 ceil(count/pageSize) 向上取整;				
	"plist"=>$rows		//商品列表

];
echo json_encode($output);

















// $output=[
// 	"count"=>0,			//商品总数量
// 	"pageSize"=>3,		//每页商品数量
// 	"pageCount"=>0,  	// 总页数 ceil(count/pageSize) 向上取整;
// 	"pno"=>$pno,		//当前第几页  从0开始
// 	"plist"=>[]		//商品列表

// ];
// // if($pno==null&&$pageCount==null&&$priceUp==ull&&$priceDown==null)
// // 	$pno=1;
// // 	$pageCount=8;
// // 	$priceUp=0;
// // 	$priceDown=2100000000;
// if($kw!=null)
// 	// echo $kw;
// 	$sql=" select lid,title,lname,price,spec from xz_laptop ";
// 	$kws=explode(" ",$kw);
// 	// var_dump($kws);
// 	for ($i=0; $i <count($kws); $i++) { 
// 		$kws[$i]=" title like '%$kws[$i]%' ";
// 	}
// 	$sql.=" where ".implode(" and ", $kws);
// 	$result=mysqli_query($conn,$sql);
// 	$products=mysqli_fetch_all($result,1);
// 	$output["count"]=count($products);
// 	$output["pageCount"]=$output["count"]/$output["pageSize"];



	













?>