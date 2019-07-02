<?php
session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: ../index.php");
}
include "../models/studentService.class.php";
$ts = new studentService();
$results = $ts->checkScore($_SESSION['student_id']);

if($results != null){
    $flag =true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生成绩</title>
    <style type="text/css">
    	#table{
    		position: absolute;
    		top: 0px;
    	}
    </style>
</head>
<body>
    <table id="table" width="90%" border="1px" cellspacing="0px" cellpadding="15px" style="color:white">
        <?php
            $rows = count($results,0);
		if($rows){?>
			<tr style="font-size: 1.5em ">
        	<td><font face="微软雅黑">课程ID</font></td>
            <td><font face="微软雅黑">课程名</font></td>
            <td><font face="微软雅黑">学分</font></td>
            <td><font face="微软雅黑">成绩</font></td><br/>
        	</tr><?php
            for($i=0;$i<$rows;$i++){
                ?>
                <tr>
                    <td><?php echo $results[$i]["course_id"] ?></td>
                    <td><?php echo $results[$i]["course_name"] ?></td>
                    <td><?php echo $results[$i]["credit"] ?></td>
                    <td><?php echo $results[$i]["grade"] ?></td><br/>
                </tr>
       <?php
            }
		}
		else echo "暂时无成绩";
        ?>

    </table>
</body>
</html>


