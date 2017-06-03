<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")  
    {  
        $user = $_POST["username"];  
        $psw = $_POST["password"];  
        if($user == "" || $psw == "")  
        {  {
            // The tab key will cycle through the settings when first created
            // Visit http://wbond.net/sublime_packages/sftp/settings for help
            
            // sftp, ftp or ftps
            "type": "sftp",
        
            "sync_down_on_open": true,
            "sync_same_age": true,
            
            "host": "example.com",
            "user": "username",
            //"password": "password",
            //"port": "22",
            
            "remote_path": "/example/path/",
            //"file_permissions": "664",
            //"dir_permissions": "775",
            
            //"extra_list_connections": 0,
        
            "connect_timeout": 30,
            //"keepalive": 120,
            //"ftp_passive_mode": true,
            //"ftp_obey_passive_host": false,
            //"ssh_key_file": "~/.ssh/id_rsa",
            //"sftp_flags": ["-F", "/path/to/ssh_config"],
            
            //"preserve_modification_times": false,
            //"remote_time_offset_in_hours": 0,
            //"remote_encoding": "utf-8",
            //"remote_locale": "C",
            //"allow_config_upload": false,
        }
        
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else  
        {  
            $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");  
             mysqli_query($con, "set names UTF8"); 
            $result = mysqli_query($con,"select username,password from try where username = '$_POST[username]' and password = '$_POST[password]'");  
            if (!$result) {
printf("Error:%s\n",mysqli_error($con));
exit();
}
            $num = mysqli_num_rows($result);  
            if($num)  
            {  
                $row = mysqli_fetch_array($result);  //将数据以索引方式储存在数组中  
                echo $row[0];  
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
  
?>  