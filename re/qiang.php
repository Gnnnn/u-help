<?php
session_start();

$request=$_GET["request"];

if($request=="qiangti"){
	$num = $_SESSION["number"];
	echo $_SESSION["is_cap"];
	$qusid=$_POST["qusid"];
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");
	$result=mysqli_query($con,"select number FROM student WHERE `qusid`={$qusid}");
	if(mysqli_num_rows($result)){
    echo json_encode(array("choose success"=>0,"error"=>1));
    echo "本题已被选过";
	return ;
    }
    $result=mysqli_query($con,"select already FROM student WHERE `number`={$num} and already is null"); //该学生是否选过 0为选过
    $result2 = mysqli_query($con,"select number from student where `already` is null");//选过的学生有多少 0为全选过了
    $result3 = mysqli_query($con,"select qusid from student where `number`={$num} and `qusid` is null");//该学生本次有没有选过 1为本次没有选
    if(mysqli_num_rows($result)== 0){
		if(mysqli_num_rows($result2)!= 0)
		    {
		    	echo json_encode(array("choose success"=>0,"error"=>2));
		    	echo "你已经选过了，本次不能再选";
		    	return ;
		    }
    }

    if(mysqli_num_rows($result3)== 0){
		    	echo json_encode(array("choose success"=>0,"error"=>3));
		    	echo "本周你已选过一题，如需选本题请先将之前的题目取消。";
		    	return ;
    }
    $result = mysqli_query($con,"UPDATE student SET `qusid`= {$qusid} where `number` = {$num};");
    echo json_encode(array("choose success"=>1));
  	// echo $result;
	return ;

}

if($request=="cancle"){
	$num = $_SESSION["number"];
	$qusid=$_POST["qusid"];
	echo $_POST["qusid"];
	if(!isset($_SESSION["number"])){
    echo json_encode(array("number"=>0));
    return ;
	}
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");

	$result=mysqli_query($con,"SELECT score FROM student WHERE `number`='10000001' and score = 0 "); //如果mcao账号score为0，说明可以取消，如果为1则禁止取消。
	//此处sql查询如果结果为0说明此时mcao_score=1，禁止取消
    if(!mysqli_num_rows($result)){
    	echo "现在已经禁止取消，取消失败。";
    	return ;
    }

	echo $qusid;
	// echo "$num"+$num;
		$result = mysqli_query($con,"UPDATE student SET `qusid`= null where `number` = {$num};");
  echo $result;
	return ;
}

  
if($request=="reset"){
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");
	mysqli_query($con,"update student set `already` = `qusid` where `already` is null;");
	mysqli_query($con,"update student set `qusid`= null;");
	mysqli_query($con,"update student set `score`= 0 where `number` = '10000001';");
	$result=mysqli_query($con,"select number FROM student WHERE `qusid`=null");
	if(!mysqli_num_rows($result)){
  $result=mysqli_query($con,"update student set qusid = null");
	return ;
    }
}
