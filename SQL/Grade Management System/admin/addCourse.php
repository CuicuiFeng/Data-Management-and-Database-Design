<div style="color:white">

<form action="" method="post">
<?php
include_once('../models/adminService.class.php');
if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    $as->addCourseInfo($_POST);
}else{

   	echo '<p>课程号：&nbsp&nbsp&nbsp<input type="text" name="course_id">';
    echo '<span style="margin-left: 50px;">课程名：<input type="text" name="course_name"></span></p>';
    echo '<p>总学分：<input type="text" name="credit">';
    echo '<span style="margin-left: 50px;">总学时：<input type="text" name="total_period"></span></p>';
    echo '<p>周课时：&nbsp&nbsp&nbsp<input type="text" name="week_period">';
    echo '<span style="margin-left: 50px;">学期：<input type="text" name="semester"></span></p>';
    echo '<p>学年：<input type="text" name="year">';
    echo '<span style="margin-left: 50px;">上课时间：&nbsp&nbsp<input type="text" name="time"></span</p>';
    echo '<p>上课教室：<input type="text" name="location">';
	echo '<span style="margin-left: 50px;">所属学院：&nbsp&nbsp<input type="text" name="department"></span</p>';
    echo '<p span style="position:absolute;left:40%;"><input type="submit" name="submit" value="提交" style="position:absolute;left: 20%"> </span></p>';
}
 ?>
</form>
</div>