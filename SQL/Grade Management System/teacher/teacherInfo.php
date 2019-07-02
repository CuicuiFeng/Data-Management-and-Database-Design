<div style="color:white">
<?php
session_start();
if(!isset($_SESSION['teacher_id'])){
    header("Location: ../index.php");
}
include "../models/teacherService.class.php";
$ts = new teacherService();
$re = $ts->checkInfo($_SESSION['teacher_id']);
//var_dump($re);
if($re != null){
    $flag =true;
}

	echo"<p style='line-height:2em'>姓名:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["teacher_name"]; else echo "null";
	echo"<span style='margin-left: 200px'>";echo "教工号:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["teacher_id"]; else echo "null";echo"</span></p>";
	echo"<p style='line-height:2em'>性别:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["sex"]; else echo "null";
	echo"<span style='margin-left: 215px'>";echo "出生日期:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["bdate"]; else echo "null";echo"</span></p>
	";
	echo"<p style='line-height:2em'>学院:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["department"]; else echo "null";
	echo"<span style='margin-left: 135px'>";echo "职称:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["profession"]; else echo "null";echo"</span></p>";
	echo"<p style='line-height:2em'>email:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["email"]; else echo "null";
	echo"<span style='margin-left: 135px'>";echo "家庭住址:&nbsp&nbsp&nbsp";if(isset($flag)) echo $re[0]["home_addr"]; else echo "null";echo"</span></p>";
	
?>
</div>