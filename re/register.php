<?php
session_start();

$request = $_GET["request"];

if($request=="clear"){
  $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
  mysqli_query($con,"SET NAMES 'UTF8'");
  $num = $_SESSION["number"];
  $result = mysqli_query($con,"UPDATE student SET `group_id`=null,`is_cap`=null WHERE 1");
  echo $result;
}

if($request=="info"){
  if(!isset($_SESSION["number"])){
    echo json_encode(array("number"=>0));
    return;
  }
  $con = mysql_connect("59.110.139.81","root","Pypy0101");
  mysql_select_db("shuclass", $con);
  mysql_query("SET NAMES 'UTF8'");
  $num = $_SESSION["number"];
  $sql = "SELECT `name`,`academy` FROM student WHERE `number`={$num};";
  $result = mysql_query($sql,$con);
  $s = mysql_fetch_array($result);
  echo  json_encode(array("number"=>$num,"name"=>$s["name"],"academy"=>$s["academy"]));
  return ;
}

if($request=="signUp"){
  if( $_POST["group_name"]=='' || $_POST["is_cap"]==''|| !isset($_SESSION["number"]) ) 
  {
    echo $_POST["group_name"];
    echo $_POST["is_cap"];
    echo isset($_SESSION["number"]);
    echo json_encode(array("success"=>0,"error"=>9));
    return ;
  } 
  else {
    // foreach ($_POST as $key => $value) {
    //   $_POST[$key]= mysqli_real_escape_string($value);
    // }
    echo signUp($_POST["group_name"],$_POST["is_cap"]);
    // generateGroup($_POST["group_name"]);
    return;
  }
}

if($request=="isSignUp"){
  if($_SESSION["number"]== '10000001'){
  echo json_encode(array("isSignUp"=>1));
    return 1;
  }
  if(!isset($_SESSION["group_id"])){
    echo json_encode(array("isSignUp"=>0));
    return ;
  }
  $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
  mysqli_query($con,"SET NAMES 'UTF8'");
  $num = $_SESSION["number"];
  $result = mysqli_query($con,"SELECT `group_id` FROM student WHERE `number`={$num};");
  $s = mysqli_fetch_array($result);
  echo json_encode(array("isSignUp"=>isset($s["group_id"]) ? 1 : 0
  ));
  return ;
}

function generateGroupList($group_id)
{
  $rand=array();
  for ($i=0;$i<30;$i++){
    $rand[]=$i;
  }
  $list=array_rand($rand,10);
  $listStr=implode(',', $list);
  $con = mysql_connect("59.110.139.81","root","Pypy0101");
  mysql_select_db("shuclass", $con);
  mysql_query("SET NAMES 'UTF8'");
  $sql = "INSERT INTO list(type,type_id,list) VALUES('0','{$group_id}','{$listStr}')";
  mysql_query($sql,$con);
}

function generatePersonList()
{
  $rand=array();
  for ($i=0;$i<30;$i++){
    $rand[]=$i;
  }
  $list=array_rand($rand,10);
  $listStr=implode(',', $list);
  $con = mysql_connect("59.110.139.81","root","Pypy0101");
  mysql_select_db("shuclass", $con);
  mysql_query("SET NAMES 'UTF8'");
  $sql = "INSERT INTO list(type,type_id,list) VALUES('1','{$_SESSION["number"]}','{$listStr}')";
  mysql_query($sql,$con);
}

function generateGroup($group_name)
{
    $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
    mysqli_query("SET NAMES 'UTF8'");
    $num = $_SESSION["number"];
    $result = mysqli_query($con,"SELECT is_cap FROM student WHERE `number`={$num}");
    $row = mysqli_fetch_array($result);
    if($row["group_name"]==null){
      return ;
    }

    if ($row["is_cap"]==1){
      $result=mysqli_query($con,"SELECT count(distinct group_name) as eg FROM student");
      $row=mysqli_fetch_array($result);
      $group_id=$row["eg"].mt_rand(10,99);
      $sql = "UPDATE student SET `group_id`='{$group_id}' WHERE `number`={$num}";
      mysql_query($sql,$con);
      generateGroupList($group_id);
    } else {
      $sql = "SELECT `group_id` FROM student WHERE `group_name`='{$group_name}'"; //eg as existed group
      $result=mysql_query($sql,$con);
      $row=mysql_fetch_array($result);
      $sql = "UPDATE student SET `group_id`='{$row["group_id"]}' WHERE `number`={$num} ";
      mysql_query($sql,$con);
    }

    generatePersonList();

}

function signUp($group_name,$is_cap)
{
    $json = array ("success"=>0,"error"=>0);
    $con = new mysqli("59.110.139.81","root","Pypy0101","shuclass");
    // mysql_select_db("shuclass", $con);
    mysqli_query($con,"SET NAMES 'UTF8'");
    $num = $_SESSION["number"];
    $result=mysqli_query($con,"SELECT group_id FROM student WHERE `number`={$_SESSION["number"]}");
    $row = mysqli_fetch_array($result);
    if($row["group_id"]!=null){
      return json_encode($json);
    }
    $result = mysqli_query($con,"SELECT count(number) FROM student WHERE `group_id`='{$_POST["group_name"]}';");

    $row = mysqli_fetch_array($result);
    $teamMatesNum=$row["count(number)"];
    if($is_cap){
      if(!$teamMatesNum){
        $json["success"]=mysqli_query($con,"UPDATE student SET `group_id`='{$_POST["group_name"]}',`is_cap`=1 WHERE `number`={$num};") ? 1 : 0;
          $_SESSION["is_cap"]=$is_cap;
          $_SESSION["group_id"]=$group_name;
        return json_encode($json);
      } else {
        $json["error"]=1;
        return json_encode($json);
      }
    } else {
      if(!$teamMatesNum){
        $json["error"]=2;
        return json_encode($json);
      } else {
        if($teamMatesNum>=3){
          $json["error"]=3;
          return json_encode($json);
        } else {
          $sql = "UPDATE student SET `group_id`='{$_POST["group_name"]}',`is_cap`=0 WHERE `number`={$_SESSION["number"]};";
          $json["success"]=mysqli_query($sql,$con) ? 1:0;
          $_SESSION["is_cap"]=$is_cap;
          $_SESSION["group_id"]=$group_name;
          return json_encode($json);
        }
      }
    }
}


?>