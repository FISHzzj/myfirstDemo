$(()=>{
	//数据管理
	$(".nav_bg").on('click', '.tit', function() {
		$tit=$(this);
		if($tit.next().is(".in"))
			$tit.next().removeClass('in');
		else
			$tit.next().addClass('in').siblings('.content.in').removeClass('in');

	});
	//超级管理员
	$(".navbar").hover(function(e) {
		e.preventDefault();
		$(this).children('<div class="drop_down"></div>').toggleClass('in');
	})
	//请求数据  // data/productLists.php
	function  checkProductsList(pno,pageSize){
		var pno=pno;
		var pageSize=pageSize;
		$reg=/^\d{1,}$/;
		var re=$reg.test(pno);
		if(!re){
			alert("页码有误");
			return;
		}
		var rs=$reg.test(pageSize);
		if(!rs){
			alert("参数大小有误");
			return;
		}
		$.ajax({
			url: 'data/productLists.php',
			type: 'get',
			dataType: 'json',
			data: {"pno":pno,"pageSize":pageSize},
			success:function(data){
				var {pageCount,pageSize,pno,products}=data;
				var pno=parseInt(pno);
				var html="";
				for(var i=0;i<products.length;i++){
				var {lid,spec,title,disk,price}=products[i];
					html+=`<tr>
							<td><input type="checkbox" class="aloneCheck"></td>
							<td>${lid}</td>
							<td>图片</td>
							<td style="padding:0 5px">${spec}</td>
							<td>${title}</td>
							<td>${disk}</td>
							<td>${price}</td>
							<td><a href="#" data-lid="${lid}" data-pno="${pno}" class="deleteOne">删除</a><br>
								<a href="#" data-lid="${lid}" data-pno="${pno}" data-title="${title}" data-price="${price}" class="updateOne">更改</a><br>
								<a href="#" data-lid="${lid}" data-pno="${pno}" class="detailOne">详情</a></td>
						  </tr>`;
				}
				$("#tbody1").html(html);
				var html="";
				if (pno-2>0) {html+=`<li><a href="#">${pno-2}</a></li>`}
				if(pno-1>0){html+=`<li><a href="#">${pno-1}</a></li>`}
				if(pno>0){html+=`<li><a href="#">${pno}</a></li>`}
				if(pno+1<=pageCount){html+=`<li><a href="#">${pno+1}</a></li>`}
				if(pno+2<=pageCount){html+=`<li><a href="#">${pno+2}</a></li>`}
				$(".pls").html(html);
			}
			
		})
	}
	checkProductsList(1,8);	
	//全选&单选&全不选(自定义封装的函数（小插件）)
	function seltAll(parentId,aloneCheck,AllCheckedId){
		$("#"+parentId).on('click', "."+aloneCheck, function() {
			var selectAll=$('.'+aloneCheck).length;
			var selectCount=0;
			$("."+aloneCheck).each(function(index, el) {
				var re=$(el).prop("checked");
				if(re){
					selectCount++;
				}else {
					selectCount--;	
				}
				if(selectCount==selectAll)
					$("#"+AllCheckedId).prop("checked",true);
				else{
					$("#"+AllCheckedId).prop("checked",false);
				}
			});
		});
		$("#"+AllCheckedId).click(function() {
			var $AllChecked=$(this);
			if($AllChecked.prop("checked")){
				$("."+aloneCheck).prop("checked",true);
			}else {
				$("."+aloneCheck).prop("checked",false);
			}
		});
	}
	seltAll("tbody1","aloneCheck","AllChecked");

	//分页
	function partPage(pageCount){
		$("."+pageCount).on('click', 'a', function(event) {
			event.preventDefault();
			$a=$(this);
			var pno=$a.html();
			checkProductsList(pno,8);	
		});
	}
	partPage("pageCount")
	//删除
	function deleProduct(parentId,deleteOne){
		$("#"+parentId).on('click', '.'+deleteOne, function(event) {
			event.preventDefault();
			$deleteOne=$(this);
			var lid=$deleteOne.data("lid");
			var pno=$deleteOne.data("pno");
			// console.log(pno);
			$.post('data/deleteChecked.php',{lid}, function(data) {
				var re=confirm("是否删除指定商品");
				if(!re){
					return;
				}
				if(data.code>0){
					alert(data.msg);
				}else{
					alert(data.msg);
				}
				checkProductsList(pno,8);
			});
		});
	}
	deleProduct("tbody1","deleteOne")
	//更新
	$("#tbody1").on('click', '.updateOne', function(event) {
		event.preventDefault();
		$updateOne=$(this);
		$(".update-jumbotron").show();
		var title=$updateOne.data("title");
		var price=$updateOne.data("price");
		var lid=$updateOne.data("lid");
		var pno=$updateOne.data("pno");
		$(".titleName").html(title).attr({"data-lid":lid,"data-pno":pno});
		$(".txtPrice").val(price);	
	});
	$(".upPrice").on('click', '.btnUpdate', function(event) {
		event.preventDefault();
		var lid=$(".titleName").data('lid');
		var pno=parseInt($(".titleName").data("pno"));
		var price=$(".txtPrice").val();
		var reg=/^\d{1,}(\.\d{2})?$/;
		if(!reg.test(price)){
			alert("请输入数字");
			return;
		}
		$.get("data/updateLists.php",{lid,price},function(data){
				var rs=confirm("是否更新");
				if(!rs){
					return;
				}
				if(data.code>0)
					alert(data.msg);
				else
					alert(data.msg);
				$(".update-jumbotron").hide();
		})
		checkProductsList(pno,8);
		
		
	});
	$(".btnCallOff").click(function(event) {
		event.preventDefault();
		$(".update-jumbotron").hide();
	});
	// 详情
	$("#tbody1").on('click', '.detailOne', function(event) {
		event.preventDefault();
		$(".detailLists").show();
		var lid=$(".detailOne").data("lid");
		$.get("data/productdetail.php",{lid},function(data){
			var {lid,lname,price,spec,disk,category,title}=data[0];
			$(".plid").html(`${title}`);
			$(".pname").html(`${lname}`);
			$(".category").html(`${category}`);
			$(".price").html(`${price}`);
			$(".pos").html(`${spec}`);
			$(".pdisk").html(`${disk}`);
		})
		
	});
	$(".btnclose").click(function(event) {
		event.preventDefault();
		$(".detailLists").hide();
	});
	//实施访问量监控//产品列表//后面还有其他功能
	$(".title_index").on('click', '[data-taggle=tab]', function(event) {
		console.log(1);
		event.preventDefault();
		// $tag=$(event.target);
		$tab=$(this);
		var Class=$tab.attr("href");
		$(Class).show().siblings().hide();
	});
	// $("[data-taggle=search]").click(function(event) {
	// 	event.preventDefault();
	// 	console.log(1);
	// 	$(".searchtxt").show();
	// 	$(".searchtxt").hide();
	// });














})