<?php                                             
if(isset($_POST['submit'])&&$_POST['submit'] == '抢题')
{
    $con = new mysqli(
        "59.110.139.81","root","Pypy0101","shuclass");
    mysqli_query($con,"set name UTF8");
    $number = $_POST['number'];
    $grp = mysqli_query($con,"select grp from student where number = '$number'");
    $ben_ti_id = $_POST['qusid'];
    $grp_user_num = mysqli_query($con,"select count(number) from student where grp = '$grp'");
    $had_bean_select = mysqli_query($con,"select * from student where qusid = '$ben_ti_id'");
    $already = mysqli_query($con,"select sum(already) from student where grp = '$grp'");
    if($had_bean_select == 1)
    {
        echo "<script> alert('该题已被抢');history.go(-1);</script>";
    }
    elseif($grp_user_num == $already){
        echo "<script> alert('本组不再进行抢题');history.go(-1);</script>";
    }
    else
    {
        $already = 1;
        echo "<script> alert('成功选择本题');history.go(-1);</script>";
		$result = mysqli_query($con, "update student set already = '$already' where number = '$number'"); 
    }
?>
