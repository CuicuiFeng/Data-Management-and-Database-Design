<div style="color:white">
<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: ../index.php");
}
include "../models/studentService.class.php";
$ts = new studentService();
$results = $ts->checkInfo($_SESSION['student_id']);
//var_dump($results);
if($results != null){
    $flag =true;
}

 	echo"<p style='line-height:2em'>姓名:&nbsp&nbsp&nbsp";echo $results[0]["stu_name"]; 
	echo"<span style='margin-left: 200px'>";echo "学号:&nbsp&nbsp&nbsp"; echo $results[0]["stu_id"]; echo"</span></p>";
	echo"<p style='line-height:2em'>性别:&nbsp&nbsp&nbsp";echo $results[0]["sex"]; 
	echo"<span style='margin-left: 232px'>";echo "出生日期:&nbsp&nbsp&nbsp";echo $results[0]["bdate"]; echo"</span></p>";
	echo"<p style='line-height:2em'>班级:&nbsp&nbsp&nbsp"; echo $results[0]["class_id"];
	echo"<span style='margin-left: 168px'>";echo "入学时间:&nbsp&nbsp&nbsp"; echo  $results[0]["entrance_date"];echo"</span></p>";
	echo"<p style='line-height:2em' >家庭住址:&nbsp&nbsp&nbsp"; echo $results[0]["home_town"]; echo"</p>";
?>
</div>