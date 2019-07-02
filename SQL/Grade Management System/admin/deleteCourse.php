<div style="color:white">

<form action="" method="post">
<?php
include_once('../models/adminService.class.php');
if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $as = new adminService();
    //var_dump($_POST);
    $as->deleteCourseInfo($_POST);
}else{
	echo '<p>课程号：&nbsp&nbsp&nbsp<input type="text" name="course_id">';
    echo '<p span style="position:absolute;left:40%;"><input type="submit" name="submit" value="删除" style="position:absolute;left: 20%"> </span></p>';
}
 ?>
</form>
</div>