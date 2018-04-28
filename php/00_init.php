<?php
header("Content-Type:application/json;charset=utf8");  //这里要加;
$conn=mysqli_connect("127.0.0.1","root","","xuezi",3306);
$sql="SET NAMES UTF8";
mysqli_query($conn,$sql);

?>