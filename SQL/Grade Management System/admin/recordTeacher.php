<div style="color:white">

<form action="recordTeacherInfo.php" method="get">
<?php
include_once('../models/adminService.class.php');

	
   	echo '<p>教师ID号：&nbsp&nbsp&nbsp<input type="text" name="teacher_id">';
    echo '<p span style="position:absolute;left:40%;"><input type="submit" name="submit" value="查找" style="position:absolute;left: 20%"> </span></p>';
	if($_GET['err']==1)echo "不合法的教师ID号!";
?>
</form>
</div>