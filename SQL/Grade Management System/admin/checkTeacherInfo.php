<div style="color:white;font-size:20px;font-face:'微软雅黑';">

<?php
// 检测是否存在Session：
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: ../index.php");
}
include_once('../models/adminService.class.php');
 ?>
<form action="" method="post" >
<?php

if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    $results = $as->checkTeacherInfo($_POST['teacher_id']);
    if($results[0])
    {
    	echo"<p style='line-height:2em'>姓名:&nbsp&nbsp&nbsp";echo $results[0]["teacher_name"]; 
		echo"<span style='margin-left: 200px'>";echo "工号:&nbsp&nbsp&nbsp";echo $results[0]["teacher_id"]; echo"</span></p>";
		echo"<p style='line-height:2em'>性别:&nbsp&nbsp&nbsp";echo $results[0]["sex"]; 
		echo"<span style='margin-left: 215px'>";echo "出生日期:&nbsp&nbsp&nbsp"; echo $results[0]["bdate"]; echo"</span></p>";
		echo"<p style='line-height:2em'>公寓名:&nbsp&nbsp&nbsp"; echo $results[0]["department"]; 
		echo"<span style='margin-left: 135px'>";echo "职称:&nbsp&nbsp&nbsp"; echo $results[0]["profession"]; echo"</span></p>"; 
		echo"<p style='line-height:2em'>家庭住址:&nbsp&nbsp&nbsp";echo $results[0]["home_addr"]; echo"</p>";
		echo"<p style='line-height:2em'>邮箱:&nbsp&nbsp&nbsp";echo $results[0]["email"]; echo"</p>";
		
    }
    else
    {
    	echo "<p style='font-size:1.5em'>请输入正确ID!</p>";
    }
    
}else{
    echo '输入老师ID：<input type="text" name="teacher_id">';
    echo '<input type="submit" name="submit" value="提交">';
}
 ?>
</form>
</div>