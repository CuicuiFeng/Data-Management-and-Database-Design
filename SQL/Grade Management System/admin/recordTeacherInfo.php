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
	$as = new adminService();
	$flag = 0;
	$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
    mysqli_set_charset($dbc, 'utf8');
	$q ="SELECT * FROM TeacherInfo WHERE teacher_id = '".$_GET['teacher_id']."'";
	$r = mysqli_query($dbc, $q);
	if(!mysqli_num_rows($r)){
		$ereg = 'T[0-9][0-9][0-9][0-9][0-9]{1}';
		if(!ereg($ereg,$_GET['teacher_id'])){//匹配教工号格式
			header("Location: ./recordTeacher.php?err=1");
			exit;
		}
		else $flag = 1;
	}
	$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
	if($flag == 1)	$row['teacher_id'] = $_GET['teacher_id'];
	

if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    $as->recordTeacherInfo($_POST);
}else{
    echo '<p>教师工号：<input type="teacher_id" name="teacher_id" value='.$row['teacher_id'].' readOnly="true">';
    echo '<span style="margin-left:30px">教师姓名：<input type="text" name="teacher_name"  value='.$row['teacher_name'].'></span></p>';
    echo '<p>教师性别：<input type="text" name="sex" value='.$row['sex'].'>';
    echo '<span style="margin-left:30px">出生日期：<input type="text" name="bdate" value='.$row['bdate'].'></span></p>';
    echo '<p>所属学院：<input type="text" name="department" value='.$row['department'].'>';
    echo '<span style="margin-left:30px">教师职位：<input type="text" name="profession" value='.$row['profession'].'></span></p>';
    echo '<p>家庭地址：<input type="text" name="home_addr"  value='.$row['home_addr'].'>';
    echo '<span style="margin-left:30px">email：<input type="text" name="email" value='.$row['email'].'></span></p>';
 
    if($flag == 1){
		echo '<p>重置密码：<input type="radio" checked="checked" name="changepwd" value="true">是';
		$flag = 0;
	}
	else{
		echo '<p>重置密码：<input type="radio" name="changepwd" checked="checked" value="true">是</[>';
    	echo '<input type="radio" name="changepwd" value="false">否';
	}
    echo '<span style="margin-left:30%"><input type="submit" name="submit" value="提交"></span>';
}
 ?>
</form>
</div>