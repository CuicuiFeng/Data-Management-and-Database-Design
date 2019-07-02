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
	$q ="SELECT * FROM StudentInfo WHERE stu_id = '".$_GET['stu_id']."'";
	$r = mysqli_query($dbc, $q);
	if(!mysqli_num_rows($r)){
		$ereg = '201[1-7][0-9][0-9][0-9][0-9][0-9][0-9]{1}';
		//echo $ereg;
		if(!ereg($ereg,$_GET['stu_id'])){//匹配学号格式
			header("Location: ./recordStudent.php?err=1");
			exit;
		}
		else	$flag = 1;
	}
	$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
	if($flag == 1)	$row['stu_id'] = $_GET['stu_id'];
	

if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as->recordStudentInfo($_POST);
}else{
    echo '<p>学号：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="stu_id" value='.$row['stu_id'].' readOnly="true">';
    echo '<span style="margin-left:50px">姓名：&nbsp &nbsp &nbsp<input type="text" name="stu_name" value='.$row['stu_name'].' ></span></p>';
    echo '<p>性别：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="sex" value='.$row['sex'].' >';
    echo '<span style="margin-left:47px">出生日期：<input type="text" name="bdate" value='.$row['bdate'].' ></span></p>';
    echo '<p>班号：<input type="text" name="class_id" value='.$row['class_id'].' >';
    echo '<span style="margin-left:47px">入学日期：<input type="text" name="entrance_date" value='.$row['entrance_date'].' ></span></p>';
	echo '<p>籍贯：<input type="text" name="home_town" value='.$row['home_town'].' ></p>';

    if($flag == 1){
		echo '<p>重置密码：<input type="radio" name="changepwd" checked="checked" value="true">是</[>';
		$flag = 0;
	}
	else {
		echo '<p>重置密码：<input type="radio" name="changepwd" checked="checked" value="true">是</[>';
    	echo '<input type="radio" name="changepwd" value="false">否';
	}
    echo '<p style="position:absolute;left:30%"><input type="submit" name="submit" value="提交"</p>';
}
 ?>

</form>
</div>