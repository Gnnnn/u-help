<?php  
    if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        $psw_confirm = $_POST["confirm"];
        $num = $_POST["number"];
        $grp = $_POST["grp"];
        if($user == "" || $psw == "" ||$num == "" ||$grp == "" || $psw_confirm == "")  
        {  
            echo "<script>alert('请确认信息完整性'); history.go(-1);</script>";  
        }  //请确认信息完整性
        else
        {  
            if($psw == $psw_confirm)  
            {  
                $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");//连接数据库
                mysqli_query($con, "set names UTF8");
                $result = mysqli_query($con,"select xm from student where xm = '$_POST[username]'");    //执行SQL语句  
                $num = mysqli_num_rows($result); //统计执行结果影响的行数  
                if($num)    //如果已经存在该用户  
                {  
                    echo "<script>alert('用户名已存在');</script>";  
                }  
                else    //不存在当前注册用户名称  
                {  
                    $res_insert = mysqli_query($con,"insert into student(number,xm,grp,password) values('$_POST[number]','$_POST[username]','$_POST[grp]','$_POST[password]')");  
                    //$num_insert = mysql_num_rows($res_insert);  
                    if($res_insert)  
                    {  
                        echo "<script>alert('注册成功'); history.go(-1);</script>";  
                    }  //注册成功
                    else  
                    {  
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";  
                    }  //系统繁忙，请稍候！
                }  
            }  
            else  
            {  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  //密码不一致！
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  //提交未成功！
?>  