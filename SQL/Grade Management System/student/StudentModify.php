<?php
// 检测是否存在Session：
session_start();

if(!isset($_SESSION['student_id'])){
    header("Location: ../index.php");
}
include_once('../models/studentService.class.php');
 ?>
<form action="" method="post">
<?php
	$ts = new studentService();

	

if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $ts->modifyPassword($_POST);
}else{
	echo '<p>学号：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="stu_id" value = '.$_SESSION['student_id'].' readOnly="true">';
    echo '<p>当前密码：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="oldpwd">';
	echo '<p>新密码：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="newpwd1">';
	echo '<p>确认新密码：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="newpwd2">';
    /*echo '<span style="margin-left:50px">姓名：&nbsp &nbsp &nbsp<input type="text" name="stu_name" value='.$row['stu_name'].' ></span></p>';
    echo '<p>性别：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="sex" value='.$row['sex'].' >';
    echo '<span style="margin-left:47px">出生日期：<input type="text" name="bdate" value='.$row['bdate'].' ></span></p>';
    echo '<p>班号：<input type="text" name="class_id" value='.$row['class_id'].' >';
    echo '<span style="margin-left:47px">入学日期：<input type="text" name="entrance_date" value='.$row['entrance_date'].' ></span></p>';
	echo '<p>籍贯：<input type="text" name="home_town" value='.$row['home_town'].' ></p>';*/
    echo '<p style="position:absolute;left:30%"><input type="submit" name="submit" value="提交"</p>';
}
 ?>

</form>
