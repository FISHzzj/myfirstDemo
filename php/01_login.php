<?php
//1.修改响应数据格式json
//2.获取参数 aname apwd
//3.创建正则表达式验证
//    aname  字母数字 3-12
//    apwd   字母数字 3-12
//4.如果验证出错停止PHP运行并且发送错误信息
//5.连接数据库
//6、创建sql语句查询数据库xz_admin表中是否存在此记录
//7、发送sql语句并且获得返回结果
//8、判断
//9、登录成功
//10、用户名或密码有误
session_start();
header("Content-Type:application/json;charset=UTF-8");
$aname=$_REQUEST["aname"];
$apwd=$_REQUEST["apwd"];
$yzm=$_REQUEST["yzm"];
@$phpyzm=$_SESSION["code"];
if($yzm !== $phpyzm){
    die('{"code":-1,"msg":"验证码有误"}');
}
//echo 1;
//echo $aname;
//echo $apwd;
 $reg='/^\w{3,12}$/';
 $rs=preg_match($reg,$aname);
 if(!$rs){
    die('{"code":-1,"msg":"用户名参数有误"}');
}
$conn=mysqli_connect("127.0.0.1","root","","xuezi","3306");
$sql=" select aid from xz_admin where aname='$aname' and apwd=md5('$apwd') ";
$result=mysqli_query($conn,$sql);
//var_dump($result);
if(mysqli_error($conn)){
    echo mysqli_error($conn);
}
$row=mysqli_fetch_row($result);
//echo 3;
if($row!==null){
    echo '{"code":1,"msg":"登录成功"}';
}else{
    echo '{"code":-1,"msg":"用户名或密码有误"}';
}





?>