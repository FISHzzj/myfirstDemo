<?php
header("Content-Type:application/json;charset=utf8");
$conn=mysqli_connect("127.0.0.1","root","","dz",3306);
$sql="SET NAME UTF8";
mysqli_query($conn,$sql);












?>