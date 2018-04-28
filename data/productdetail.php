<?php
require("00_init.php");
$lid=$_REQUEST["lid"];
$reg='/^\d{1,}$/';
$re=preg_match($reg, $lid);
if(!$re){
	die('{"code":-1,"msg":"lid 参数有错"}');
}
$sql="select lid,lname,price,spec,disk,category,title from dz_laptop where lid=$lid";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_all($result,1);
echo json_encode($row);



















?>