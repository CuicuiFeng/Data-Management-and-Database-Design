<div style="color:white">
<?php
// 检测是否存在Session：
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: ../index.php");
}
include_once('../models/adminService.class.php');
 ?>
<form action="" method="post">
<?php

if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    $results = $as->checkCourseInfo($_POST['course_id']);
?>
<?php
	if($results)
	{
?>
   <p style='line-height:2em'><font style="font-size:20px" face="微软雅黑">课程号:&nbsp&nbsp <?php echo $results[0]['course_id'];?>
 	  <span style='margin-left: 200px'> <font style="font-size:20px" face="微软雅黑">课程名:&nbsp&nbsp <?php echo $results[0]['course_name'];?>
</span></p>
   <p style='line-height:2em'><font style="font-size:20px" face="微软雅黑">学分:&nbsp&nbsp  <?php echo $results[0]['credit'];?>
      <span style='margin-left: 230px'> <font style="font-size:20px" face="微软雅黑">学时:&nbsp&nbsp <?php echo $results[0]['total_period'];?>
</span></p>
   <p style='line-height:2em'><font style="font-size:20px" face="微软雅黑">周课时:&nbsp&nbsp <?php echo $results[0]['week_period'];?>
      <span style='margin-left: 230px'> <font style="font-size:20px" face="微软雅黑">所在学期:&nbsp&nbsp <?php echo $results[0]['semester'];?>
</span></p>
   <p style='line-height:2em'><font style="font-size:20px" face="微软雅黑">所在学年:&nbsp&nbsp <?php echo $results[0]['year'];?>
   	  <span style='margin-left: 175px'> <font style="font-size:20px" face="微软雅黑">上课时间:&nbsp&nbsp <?php echo $results[0]['time'];?>
</span></p>
   <p style='line-height:2em'><font style="font-size:20px" face="微软雅黑">上课地点:&nbsp&nbsp <?php echo $results[0]['location'];?>
   	  <span style='margin-left: 150px'> <font style="font-size:20px" face="微软雅黑">所属院系:&nbsp&nbsp <?php echo $results[0]['department'];?>
</span></p>
<?php
	}
	else
	{
		echo "<p style='font-size:1.5em'>请输入正确ID!</p>";
	}
?>
<?php
}
else{
    echo '输入课程号：<input type="text" name="course_id">';
    echo '<input type="submit" name="submit" value="提交">';
}
 ?>
</form>
</div>