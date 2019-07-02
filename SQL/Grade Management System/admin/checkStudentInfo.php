<div style="color:white;font-size:20px;face=\"微软雅黑\";">

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
    $results = $as->checkStudentInfo($_POST['student_id']);
 if($results[0])
 {
 	echo"<p style='line-height:2em'>姓名:&nbsp&nbsp&nbsp";echo $results[0]["stu_name"]; 
	echo"<span style='margin-left: 200px'>";echo "学号:&nbsp&nbsp&nbsp"; echo $results[0]["stu_id"]; echo"</span></p>";
	echo"<p style='line-height:2em'>性别:&nbsp&nbsp&nbsp";echo $results[0]["sex"]; 
	echo"<span style='margin-left: 232px'>";echo "出生日期:&nbsp&nbsp&nbsp";echo $results[0]["bdate"]; echo"</span></p>";
	echo"<p style='line-height:2em'>班级:&nbsp&nbsp&nbsp"; echo $results[0]["class_id"];
	echo"<span style='margin-left: 168px'>";echo "入学时间:&nbsp&nbsp&nbsp"; echo  $results[0]["entrance_date"];echo"</span></p>";
	echo"<p style='line-height:2em' >家庭住址:&nbsp&nbsp&nbsp"; echo $results[0]["home_town"]; echo"</p>";
}
else
{
	echo "<p style='font-size:1.5em'>请输入正确ID!</p>";
}
}else{

    echo '输入学生学号：<input type="text" name="student_id" >';
    echo '<input type="submit" name="submit" value="提交">';
}
 ?>
</form>
</div>