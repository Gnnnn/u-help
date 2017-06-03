<?php
session_start();

$request=$_GET["request"];

if($request=="forbiden"){
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");
	$result=mysqli_query($con,"update student set `score` = 1 where `number` = '10000001'"); //如果mcao账号score为0，说明可以取消，如果为1则禁止取消。
	echo "已经禁止";
}

if($request=="qusinfo"){
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");
	$result=mysqli_query($con,"update quslist set `qus1` = '{$_POST["qus1"]}',`qus2` = '{$_POST["qus2"]}',`qus3` = '{$_POST["qus3"]}',`qus4` = '{$_POST["qus4"]}',`qus5` = '{$_POST["qus5"]}',`qus6` = '{$_POST["qus6"]}' where `id` = '{$_POST["id"]}';");
	echo "数据库已经更新";
}

if($request =="qus"){
	$con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
	mysqli_query($con,"SET NAMES 'UTF8'");
	$result=mysqli_query($con,"select id from quslist where qus1 is null and qus2 is null;");
	$id = 9-mysqli_num_rows($result);
  	$result=mysqli_query($con,"select qus1,qus2,qus3,qus4,qus5,qus6 from quslist where id = {$id};");
  	$row = mysqli_fetch_array($result);
  	// echo $row["qus1"]." ".$row["qus2"]." ".$row["qus3"]." ".$row["qus4"]." ".$row["qus5"]." ".$row["qus6"];
    $listJson=array();
  	
      echo json_encode(array("success"=>1,"qus1"=>$row["qus1"],"qus2"=>$row["qus2"],"qus3"=>$row["qus3"],"qus4"=>$row["qus4"],"qus5"=>$row["qus5"],"qus6"=>$row["qus6"]));

  	return ;
}
