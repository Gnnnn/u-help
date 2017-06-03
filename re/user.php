<?php
session_start();

$request = $_GET["request"];

if($request=="info"){
  if($_SESSION["number"] == "10000001"){
      $json["number"]="10000001";
      $json["group_id"]="0";
      $json["is_cap"]="1";
    echo json_encode($json);
    return ;
  }
  if(!isset($_SESSION["number"])){
    echo json_encode(array("number"=>0));
    return ;
  }
  $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
  mysqli_query($con,"SET NAMES 'UTF8'");
  $num = $_SESSION["number"];
  $result = mysqli_query($con,"SELECT * FROM student WHERE `number`={$num};");
  $s = mysqli_fetch_array($result,MYSQLI_BOTH);
  $json["number"]=$num;
  $json["group_id"]=$s["group_id"];
  $json["is_cap"]=$s["is_cap"];
  echo  json_encode($json);
  return ;
} 

if($request=="amimcao"){
  if(!isset($_SESSION["number"])){
    echo json_encode(array("number"=>0));
    return ;
  }
  
  if ($_SESSION["number"]!= 10000001){
    echo "you are not mcao!";
    // $home_url = '../index.html';
// header('Location:'.$home_url);
    return ;
  }
  $result = 1;
  echo $result;
  return ;
} 

if($request=="logout"){
if(isset($_SESSION['number'])){
  //要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
  $_SESSION = array();
  //如果存在一个会话cookie，通过将到期时间设置为之前1个小时从而将其删除
  if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-3600);
  }
  session_destroy();
  }
  return ;
} 