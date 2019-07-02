<div style="color:white">


<form action="" method="post">
<?php
include_once('../models/adminService.class.php');
	$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
    mysqli_set_charset($dbc, 'utf8');
	$q ="SELECT * FROM CourseInfo WHERE course_id = '".$_GET['course_id']."'";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    //var_dump($row);
   if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    //var_dump($_POST);
    $as->updateCourseInfo($_POST);
   }
   else
   {
	echo '<p>课程号：&nbsp&nbsp&nbsp<input type="text" name="course_id" value ='.$row['course_id'].' readOnly="true">';
    echo '<span style="margin-left: 50px;">课程名：<input type="text" name="course_name" value='.$row['course_name'].'></span></p>';
    echo '<p>总学分：<input type="text" name="credit" value='.$row['credit'].'>';
    echo '<span style="margin-left: 50px;">总学时：<input type="text" name="total_period" value='.$row['total_period'].'></span></p>';
    echo '<p>周课时：&nbsp&nbsp&nbsp<input type="text" name="week_period" value='.$row['week_period'].'>';
    echo '<span style="margin-left: 50px;">学期：<input type="text" name="semester" value='.$row['semester'].'></span></p>';
    echo '<p>学年：<input type="text" name="year" value='.$row['year'].'>';
    echo '<span style="margin-left: 50px;">上课时间：&nbsp&nbsp<input type="text" name="time" value='.$row['time'].'></span</p>';
    echo '<p>上课教室：<input type="text" name="location" value='.$row['location'].'>';
	echo '<span style="margin-left: 50px;">所属学院：&nbsp&nbsp<input type="text" name="department" value='.$row['department'].'></span</p>';
    echo '<p span style="position:absolute;left:40%;"><input type="submit" name="submit" value="提交" style="position:absolute;left: 20%"> </span></p>';	
	}
	
 ?>
</form>
</div>