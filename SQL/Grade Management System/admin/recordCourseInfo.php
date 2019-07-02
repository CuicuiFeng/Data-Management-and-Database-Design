<div style="color:white">

<?php
// 检测是否存在Session：
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: ../index.php");
}
include_once('../models/adminService.class.php');
 ?>
 <a href="addCourse.php" target="iframe_a"><div>增加课程</div></a>
 <a href="updateCourse.php" target="iframe_a"><div>更改课程</div></a>
 <a href="deleteCourse.php" target="iframe_a"><div>删除课程</div></a>
 </div>

