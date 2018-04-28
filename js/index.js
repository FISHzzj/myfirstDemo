/**
 * Created by web-01 on 2018/2/11.
 */
$(()=>{
    $("a.btn").click(function(e){
        e.preventDefault()
        var aname=$("input:text").val();
        var apwd=$("input:password").val();
        // 1.获得用户输入的验证码
         var yzm=$("#yzm").val();
        // 2.创建正则表达式
        var regYzm=/^[a-zA-Z0-9]{4}$/;
        if(!regYzm.test(yzm)){
            alert("验证码输入不正确");
            return;
        }
        var Reg=/^\w{6,12}$/;
        if(!Reg.test(aname)){
            alert("用户名格式不正确 6-12位字母数字");
            return;
        }
        if(!Reg.test(apwd)){
            alert("用户密码格式不正确 6-12位字母数字");
            return;
        }
        $.getJSON("data/01_login.php",
                 {aname:aname,apwd:apwd,yzm:yzm },
                function success(data){
                    console.log(data);
                    if (data.code==1){
                        alert("登录成功");
                        location.href="main.html";
                    }else{
                        alert(data);
                        // alert("用户名或密码错误")
                    }
                },
                function error(err){
                    console.log(err);
                }
        )


    });




})





