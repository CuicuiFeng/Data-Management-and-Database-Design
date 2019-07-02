<div style="color:white">


<form action="updateCourseInfo.php" method="get">
<?php
include_once('../models/adminService.class.php');


   	echo '<p>课程号：&nbsp&nbsp&nbsp<input type="text" name="course_id">';
    echo '<p span style="position:absolute;left:40%;"><input type="submit" name="submit" value="查找" style="position:absolute;left: 20%"> </span></p>';
?>
</form>
</div>