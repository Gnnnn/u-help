jQuery(document).ready(function($){
	ifmcao();
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
}),

$('.home').click(function(){
	self.location = "index.html"
}),

$('.forbiden').click(function(){
	$.getJSON("/qk/re/mcao.php?request=forbiden",function(data){
    console.log(data)
  })
}),

$(".confirmqusnum").click(function(){
var qusnum = $(".qusnum").val();
console.log(qusnum);
for (var i=(qusnum+1);i<=6;i++) {
	var a = ".qus"+i;
	console.log(a);
	$(a).hide();
	console.log("hide")
}
});

$(".qusinfo").click(function(){
var id = $(".id").val();
var qunum1 = $(".qus1").val();
var qunum2 = $(".qus2").val();
var qunum3 = $(".qus3").val();
var qunum4 = $(".qus4").val();
var qunum5 = $(".qus5").val();
var qunum6 = $(".qus6").val();
console.log("qusinfo");
	$.ajax({
    url:"/qk/re/mcao.php?request=qusinfo",
    type:"post",
    dataType:"json",
    data:{
    	id:id,
    	qus1:$(".qus1").val(),
    	qus2:$(".qus2").val(),
    	qus3:$(".qus3").val(),
    	qus4:$(".qus4").val(),
    	qus5:$(".qus5").val(),
    	qus6:$(".qus6").val()
    },
    success:function(result){
		console.log(result)
	},   
	error:function(result){
		console.log(result)
	}
	});
// console.log(qusnum)
})

});

function ifmcao(){
	$.ajax({
    url:"/qk/re/user.php?request=amimcao",
    type:"post",
    dataType:"json",
    data:{
    	
    },
    success:function(result){
		console.log(result)
	},   
	error:function(result){
		console.log(result);
		alert("你不具有权限进入该页面。");
		//self.location='index.html';

	}
	})
}