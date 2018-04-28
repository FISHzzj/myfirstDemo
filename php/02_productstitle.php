<?php
require_once("00_init.php");
//header("Content-Type:application/json;charset=UTF-8");
@$pno=$_REQUEST["pno"];  //当前页码
@$pageSize=$_REQUEST["pageSize"]; //每页的产品数量
if(!$pno)
	$pno=1;
if(!$pageSize)
	$pageSize=8;
$reg='/^\d{1,}$/';
$rs=preg_match($reg, $pno);
// echo $rs;
if(!$rs)
	die('{"code":-1,"msg":"当前输入的页数码有误"}');
$offset=($pno-1)*$pageSize;
$sql="select lid,title,lname,price,spec,(select sm from xz_laptop_pic where laptop_id=lid limit 1) as sm from xz_laptop limit $offset,$pageSize";
//$conn=mysqli_connect("127.0.0.1","root","","xuezi",3306);
$result=mysqli_query($conn,$sql);
// echo $result;
$rows=mysqli_fetch_all($result,1);
//7.创建sql语句查询总记录数，并计算处总页数
// echo json_encode($rows);
$sql="select count(lid) from xz_laptop";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result); //抓取一行数据
//var_dump($row[0]);//$row[0]得到下标为0的数值
$pageCount=ceil($row[0]/$pageSize);//总的页数
//var_dump($pageCount);
//8.创建数组拼接结果pno  pageSize  pageCount data
$output=[
    "pno"=>$pno,
    "pageSize"=>$pageSize,
    "pageCount"=>$pageCount,
    "datas"=>$rows
];
echo json_encode($output);


//echo json_encode($row);

?>