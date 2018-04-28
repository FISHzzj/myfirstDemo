$(()=>{
	$("#btn").click(function(e) {
		e.preventDefault();
		// console.log(1);
		var aname=$("#uname").val();
		var apwd=$("#upwd").val();
		var yzm=$("#yzm").val();
		$.ajax({
			url: 'data/login.php',
			type: 'get',
			data: {aname:aname,apwd:apwd,yzm:yzm}, //这里不需要加"";
			dataType:"json",
			success:function(data){
					console.log(data);
				if(data.code==-1){
					alert(data.msg);
				}else {
					alert(data.msg);
				}
			}
		})

	})
})
	
	














