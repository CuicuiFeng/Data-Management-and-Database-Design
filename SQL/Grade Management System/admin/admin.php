<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 2016/7/8
 * Time: 18:33
 */
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: ../index.php");
}

include "../models/adminService.class.php";
$ts = new adminService();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="../css/main2.css"/>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="keywords" content="button, effect, hover, style, inspiration, web design" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../css/buttons.css" />
        
		<script src="../js/index.js"></script>
		<title>信息显示页</title>
	</head>
	<body onload="show()">					
		<div id="head">
			<img src="../img/logo.png"><span>&nbsp;EDUAS教务系统</span>
			<div id="nowtime"></div>
			<div id="info">
				<div>欢迎光临&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<a href="../logout.php"><div id="log_off" >注销</div></a>
				<a href="AdminModify.php"><div style="margin-left: 10px;">修改密码</div></a>
			</div>
		</div>
		<div id="background"></br>
        	<iframe id="textArea2"></iframe>
			<iframe id="textArea" src="checkStudentInfo.php" name="iframe_a" frameborder="no"></iframe>
			<div id="navigation">
            	<div class="box bg-3">
					<div id="button1">
                        <a href="checkStudentInfo.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="StudentInfo" ><span>查看学生信息</span></button></a>
                    </div>
                    <div id="button2">
                        <a href="checkTeacherInfo.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="TeacherInfo" ><span>查看老师信息</span></button></a>
					</div>
                    <div id="button3">
                        <a href="checkCourseInfo.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="CourseInfo" ><span>查看课程信息</span></button></a>
                    </div>
                    <div id="button4">
                        <a href="recordCourseInfo.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="RecordCourse" ><span>课程信息修改</span></button></a>
					</div>
                    <div id="button5">
                        <a href="recordStudent.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="RecordStudent" ><span>编辑学生信息</span></button></a>
                    </div>
                    <div id="button6">
                        <a href="recordTeacher.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="RecordTeacher" ><span>编辑老师信息</span></button></a>
					</div>
                 </div>
			</div>
		</div>
	</body>
</html>