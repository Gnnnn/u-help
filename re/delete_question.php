<?php                                             
if(isset($_POST['delete'])&&$_POST['delete'] == '删除')
{
    $con = new mysqli(
        "59.110.139.81","root","Pypy0101","shuclass");
    mysqli_query($con,"set name UTF8");
    $number = $_POST['number'];
    $grp = mysqli_query($con,"select grp from student where number = '$number'");
    $ben_ti_id = $_POST['qusid'];
    $grp_user_num = mysqli_query($con,"select count(number) from student where grp = '$grp'");
    $had_bean_select = mysqli_query($con,"select * from student where qusid = '$ben_ti_id'");
    $already = mysqli_query($con,"select already from student where  number = '$number'");
	$qusid = mysqli_query($con, "select qusid from student where qusid = '$ben_ti_id'")    
	if($already == 1 and $qusid == $ben_ti_id)
    {
        echo "<script> alert('该题已被取消');history.go(-1);</script>";
		$result = mysqli_query($con, "update student set already = 0 where number = '$number'"); 
    }
    else if($qusid == $ben_ti_id and $already  == 0)
	{
		echo "<script> alert('你已取消选择该题，不能重新选择');history.go(-1);</script>";
	}
	else
	{
		echo "<script> alert('你未选中该题');history.go(-1);</script>"
	}
?>
