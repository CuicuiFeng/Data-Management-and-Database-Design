<div style="color:white">
<?php
// 检测是否存在Session：
	session_start();
	if(!isset($_SESSION['teacher_id'])){
   	 header("Location: ../index.php");
	}
	include_once('../models/teacherService.class.php');
	$ts = new teacherService();
	$results = $ts->getTeachCourses($_SESSION['teacher_id']);
?>


<form name="course_name" method="post" action="">



<?php
if($_SERVER['REQUEST_METHOD']  == 'POST'){
	if(isset($_POST['course_id']) && !isset($_POST['stu_id']) && !isset($_POST['socre'])){
	    $ts = new teacherService();
    	$re = $ts->getStudentIDs($_POST[select]);
		$rows = count($re,0);
		?>
		<table width="280" border="0" cellpadding="0" cellspacing="0">
		<tr>
			
			<td width="194">
            	<p width="80" height="20" align="center"><span class="style2" style="color:white">学号选择：</span>
				<select name="select_stu_id" size="1">
					<?php foreach($re as $temp){ ?>
						<option value="<?php echo $temp['stu_id']; ?>"> <?php echo $temp['stu_id']; ?> </option>;
           	         <?php
					} ?>
				</select>&nbsp;&nbsp;&nbsp;</p>
                <p width="80" height="20" align="center"><span class="style2" style="color:white">课程号：</span>
                <input type="text" name="course_id" value=<?php echo $_POST['select'] ?> readOnly="true"  /></p>
                <p width="80" height="20" align="center"><span class="style2" style="color:white">成绩：</span>
                <input type="text" name="score" value="0" /></p>
				<input type="submit" name="stu_id" value="提交">
			</td>
		</tr>
		</table	>
<?php		}
	  else if(isset($_POST['score'])){
		  $ts = new teacherService();
		  $ts->modifyScore($_POST['course_id'],$_POST['select_stu_id'],$_POST['score']);
	  }

 }
	else{ ?>
 	<table width="280" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="80" height="20" align="center"><span class="style2" style="color:white">课程选择：</span></td>
		<td width="194">
			<select name="select" size="1">
				<?php foreach($results as $temp){ ?>
					<option value="<?php echo $temp['course_id']; ?>"> <?php echo $temp['course_name']; ?> </option>;
                    <?php
				} ?>
			</select>&nbsp;&nbsp;&nbsp;
			<input type="submit" name="course_id" value="提交">
			</td>
		</tr>
	</table	>
</form>
<?php 
}
?>
</div>

