function Gnsignup(){
    $('#gotoregister').show();
    $('#loginTable').hide();
    console.log("hide&show");
    $('.Gnregister').click(function(){
        var Gngroup_id = $("#groupid").val();
        console.log(Gngroup_id)
        var Gnis_cap = 0;
        if ($('input[name="leader"]:checked').val() == "yep")
            Gnis_cap = 1;
        else
            Gnis_cap = 0;

        // 此处为注册路由，/qk/re/register.php?request=signUp，传入组号和是否为组长，返回信息。
        $.ajax({
            url:"/qk/re/register.php?request=signUp",
            dataType:"json",
            type:"post",
            aysnc:false,
            data:{
                group_name:Gngroup_id,
                is_cap:Gnis_cap
            },
            success:function(result){
                if(result.success == 1){
                    $("#gotoqiang").show();

                    console.log("注册小组信息成功")
                }
                else{
                    if(result.error==0)
                        alert("请刷新重试");
                    else if(result.error == 1)
                        alert("该队伍已存在，您不能成为组长");
                    else if(result.error==2)
                        alert("队伍暂不存在，需要组长先组队");
                    else if(result.error==3)
                        alert("队伍人数已满，不能继续加入");
                    console.log(result)
                }
            },
            error:function(result){
                if(result==0)
                    alert("请刷新重试error");
                else if(result == 1)
                    alert("该队伍已存在，您不能成为组长error");
                else if(result==2)
                    alert("队伍暂不存在，需要组长先组队error");
                else if(result==3)
                    alert("队伍人数已满，不能继续加入error")
            }
        })
    })
}

function mcao()
{
    $.getJSON("/qk/re/user.php?request=info",function(data){
        console.log(data);
        if (data.number== '10000001') {
            console.log("曹老师好~！");
            $("#gotomcao").show();
            $("#gotoqiang").show();

        }
    })
}


function indexIsLogin()
{
    $.getJSON("/qk/re/user.php?request=info",function(data){
        console.log(data);
        if (data.number== 0) {
            console.log("没有登录");
        }
        else if(!data.group_id){ //not register
            console.log("没有注册");
            console.log("hei");
            Gnsignup()
        }
        else{ //login
            console.log("login")
                $("#gotoqiang").show();

        }
    })
}

$(document).ready(function() {
	indexIsLogin() 
// 点login按钮，路由re/logops.php?request=login，传username和
// password，返回result，success为登录成功，如果登录成功但没有注册小组
// 进入注册函数，一个小组默认不多于三个人，逻辑为组长先注册，小组成立，其他组员才可加入
	$('.login').click(function(){
	  $.ajax({
	      url:"re/logops.php?request=login",
	      type:"post",
	      dataType:"json",
	      aysnc:false,
	      data:
	      {
          // username: '10000001',
          // password:'10000001',
	        username: $(".userid").val(),
	        password:$(".password").val()
	      }, 
	      success:function(result){
	      	// console.log("success")
	        if (result.success) {
	          $.getJSON("/qk/re/register.php?request=isSignUp",function(data){
	          GnisSignUp = data.isSignUp;
	          if (result.success) {
	            if( GnisSignUp==0)
	            {
                console.log("没有注册");
	              Gnsignup();
                $("#gotoqiang").show();
	            }
	            else{
                  $("#gotoqiang").show();
	                console.log("已登录，已注册");
                  mcao();
	            }
	          }
	          else{
	              console.log("登录失败");
	              $(".password").val("")
	          	}
	            })
	        }
	        else{
	          console.log(result);
	              console.log("登录失败");
	              $(".password").val("")
	        }
	      },
	      error:function(result){
	      	console.log("fail");
	        console.log(result)
	      }

	  })
})


})



