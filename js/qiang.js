jQuery(document).ready(function($) { 
	// WhoAreYou()
	getqus();
	$('.qiang1').click(function(){
	console.log("qiang1_click");
	qusid = 1;
	console.log(qusid);
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
            console.log('<p>您已抢到该题</p>');
	    	$(".qiang1").val("您已抢到该题");
            $(".no").hide();

   		console.log(result)
		},   
		error:function(result){
	    	if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
	    		alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
			}
			else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
			}
   			console.log(result)
		}
		})
}),
$('.qiang2').click(function(){
		qusid = 2;
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
   		console.log(result);
		console.log("您已抢到该题");
		$(".qiang2").val("您已抢到该题");
		$(".no").hide();
		},   
		error:function(result){
            if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
                alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
            }
            else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
            }
   		console.log(result)
		}
		})
}),
$('.qiang3').click(function(){
		qusid = 3;
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
   		console.log(result);
   		console.log("您已抢到该题");
		$(".qiang3").val("您已抢到该题");
		$(".no").hide();
		},   
		error:function(result){
            if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
                alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
            }
            else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
            }
   		console.log(result)
		}
		})
}),
$('.qiang4').click(function(){
		qusid = 4;
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
   		console.log(result);
   		console.log("您已抢到该题");
		$(".qiang4").val("您已抢到该题");
		$(".no").hide();
		},   
		error:function(result){
            if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
                alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
            }
            else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
            }
   		console.log(result)
		}
		})
}),
$('.qiang5').click(function(){
		qusid = 5;
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
   		console.log(result);
   		console.log("您已抢到该题");
		$(".qiang4").val("您已抢到该题");
		$(".no").hide();
		},   
		error:function(result){
            if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
                alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
            }
            else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
            }
   		console.log(result)
		}
		})
}),
$('.qiang6').click(function(){
		qusid = 6;
	$.ajax({
	    url:"/qk/re/qiang.php?request=qiangti",
	    type:"post",
	    dataType:"json",
	    data:{
	    	qusid : qusid
	    },
	    success:function(result){
   		console.log(result);
   		console.log("您已抢到该题");
		$(".qiang4").val("您已抢到该题");
		$(".no").hide();
		},   
		error:function(result){
            if(result.responseText==='{"choose success":0,"error":3}本周你已选过一题，如需选本题请先将之前的题目取消。'){
                alert("本周你已选过一题，如需选本题请先将之前的题目取消。");
            }
            else if(result.responseText==='{"choose success":0,"error":1}本题已被选过'){
                alert("本题已被选过");
            }
   		console.log(result)
		}
		})
}),
$('.no').click(function(){
	console.log("no_click");
	// console.log(qusid)
	$.ajax({
	    url:"/qk/re/qiang.php?request=cancle",
	    type:"post",
	    dataType:"json",
	    data:{
	    },
	    success:function(result){
            $(".qiang1").val("抢题");
            $(".qiang2").val("抢题");
            $(".qiang3").val("抢题");
            $(".qiang4").val("抢题");
            $(".qiang5").val("抢题");
            $(".qiang6").val("抢题");
   		console.log(result)
		},   
		error:function(result){
   		console.log(result)
		}
		})
}),
$('.logout').click(function(){
	console.log("logout")
	$.ajax({
	    url:"/qk/re/user.php?request=logout",
	    type:"post",
	    dataType:"json",
	    data:{
	    },
	    success:function(result){
   		console.log("byebye");
   		console.log(result);
		window.location.href='index.html'; 
		},   
		error:function(result){
   		console.log(result);
		window.location.href='index.html'; 
   		
		}
		})
}),
$('.home').click(function(){
	self.location = "index.html"
}),
$('.reset').click(function(){
	$.ajax({
	    url:"/qk/re/qiang.php?request=reset",
	    type:"post",
	    dataType:"json",
	    data:{
	    	
	    },
	    success:function(result){
   		console.log(result)
		},   
		error:function(result){
   		console.log(result)
		}
		})
})
})

//不是组长，无法抢题的逻辑前端实现，把按钮设为不可点击。
function WhoAreYou(){
	console.log("ohohoho~ who r u ?");
	$.getJSON("/qk/re/user.php?request=info",function(data){
		console.log(data);
   		if(data.is_cap != 1){
   			alert("您不是组长，无法抢题！")
   		}
		})
}

function isallchosen(){
	$.ajax({
	    url:"/qk/re/qiang.php?request=isallchosen",
	    type:"post",
	    dataType:"json",
	    success:function(result){
   		console.log(result)
		},   
		error:function(result){
   		console.log(result)
		}
		})
}

function getqus(){
	console.log("here,getqus");
	$.getJSON("/qk/re/mcao.php?request=qus",function(data){
		if(data.success){
			console.log("here getJSON success");
			console.log(data.qus1);
			$(".qus1").text( "第 1 题：" +data.qus1);
			$(".qus2").text( "第 2 题：" +data.qus2);
			$(".qus3").text( "第 3 题：" +data.qus3);
			$(".qus4").text( "第 4 题：" +data.qus4);
			$(".qus5").text( "第 5 题：" +data.qus5);
			$(".qus6").text( "第 6 题：" +data.qus6)

		}
		else{
			console.log("fuck you ")
		}
	})
}