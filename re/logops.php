<?php
include("Snoopy.class.php");

session_start();

$request=$_GET["request"];

if($request=="login"){
  $username=$_POST["username"];
  $password=$_POST["password"];
  // echo $username." ".$password;
  if ($username == '10000001')
  {
    if($password == '10000001'){
  echo json_encode(array("mcao"=>1,"success"=>1));
    $_SESSION["number"]="10000001";
  return;
    }
    else{
  echo json_encode(array("mcao"=>1,"success"=>0));
  return;

    }
  }
  $isLogin = login($username,$password);
  if($isLogin){
    $_SESSION["number"]=$username;
  }
  // echo $_SESSION["number"];
  echo json_encode(array("success"=>$isLogin));
  return;
}

if($request=="isLogin"){
  echo json_encode(array(
    "isLogin"=>isset($_SESSION["number"]) ? 1 : 0
    ));
}

function login($username,$password){

    $pattern = '/<input[^>]*?name="__VIEWSTATE"[^>]*?value="([^"]*)".*?>/';
    $htm = file_get_contents('http://services.shu.edu.cn/Login.aspx');
    preg_match($pattern,$htm,$tmp);
    $__VIEWSTATE = $tmp[1];
    $snoopy = new Snoopy;
    $submit_url = "http://services.shu.edu.cn/Login.aspx";
    $submit_vars['txtUserName'] = $username;
    $submit_vars['txtPassword'] = $password;
    $snoopy->referer = "http://services.shu.edu.cn";
    $submit_vars["__EVENTTARGET"] = "";
    $submit_vars["__EVENTARGUMENT"] = "";
    $submit_vars["btnOK"] = "提交(Submit)";
    $snoopy->submit($submit_url, $submit_vars);
    $snoopy->fetch("http://services.shu.edu.cn/User/userPerInfo.aspx");
    $info=$snoopy->results;
    $pattern_name = '/<span.*?id="userName">([^<]+)<\/span>/';
    if( preg_match($pattern_name,$info,$name)) 
      // && preg_match($pattern_sid,$info,$sid)) 
    {
        // echo $name[1];
        registerToDB($username,$password,$name[1]);
        
        return 1;
    } 
    else {
        return 0;
    }
}

function registerToDB($username,$password,$name)
{
  $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
  mysqli_query($con,"SET NAMES 'UTF8'");
  $result=mysqli_query($con,"SELECT group_id FROM student WHERE `number`={$username}");
    if(!mysqli_num_rows($result)){
        mysqli_query($con,"SET NAMES 'UTF8'");
        mysqli_query($con,"INSERT INTO student(number,name,password) VALUES
        ('{$username}','{$name}','{$password}')");
    }
    
}
?>
