<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 2016/7/8
 * Time: 18:33
 */
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
				<div id="name"> <?php if(isset($flag)) echo $re[0]["teacher_name"]; else echo "姓名";?>&nbsp;&nbsp;</div> 
				<a href="../logout.php"><div id="log_off" >注销</div></a>
				<a href="TeacherModify.php"><div style="margin-left: 10px;">修改密码</div></a>
			</div>
		</div>
		<div id="background"></br>
        	<iframe id="textArea2" ></iframe>
			<iframe id="textArea" src="teacherInfo.php" name="iframe_a" frameborder="no"></iframe>
			<div id="navigation">
                <div class="box bg-3">
					<div id="button1">
                        <a href="teacherInfo.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="Info" ><span>个 人 信 息</span></button></a>
                    </div>
                    <div id="button2">
                        <a href="checkScore.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="Grades" ><span>成 绩 查 询</span></button></a>
					</div>
                    <div id="button3">
                        <a href="recordScore.php" target="iframe_a">
                        <button class="button button--tamaya button--round-s button--text-thick button--border-thin" data-text="Record" ><span>录 入 成 绩</span></button></a>
					</div>
                </div>
			</div>
		</div>
	</body>
</html>