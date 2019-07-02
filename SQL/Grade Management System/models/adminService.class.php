<?php
/**
* adminService.class.php : 提供系统管理员的操作
*/
include_once('conn.php');

class adminService
{

    public function __construct()
    {
        # code...
    }

    public function checkStudentInfo($sid){    // 使用 学生id 作为参数
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        $results = array();
        $q = "SELECT * FROM StudentInfo WHERE stu_id='$sid'";
        $r = mysqli_query($dbc, $q);
        if($r)
            while($row = mysqli_fetch_array($r)){
                $results[] = $row;
            }
        else
            echo '无此ID的学生';

        mysqli_close($dbc);

        return $results;
    }

    public function checkTeacherInfo($tid){    // 使用 教师id 作为参数
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        $results = array();
        $q = "SELECT * FROM TeacherInfo WHERE teacher_id='$tid'";
        $r = mysqli_query($dbc, $q);
        if($r)
            while($row = mysqli_fetch_array($r)){
                $results[] = $row;
            }
        else
            echo '无此ID的教师';

        mysqli_close($dbc);

        return $results;
    }

    public function checkCourseInfo($cid){    // 使用 课程id 作为参数
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        $results = array();
        $q = "SELECT * FROM CourseInfo WHERE course_id='$cid'";
        $r = mysqli_query($dbc, $q);
        if($r)
            while($row = mysqli_fetch_array($r)){
                $results[] = $row;
            }
        else
            echo '无此ID的课程';

        mysqli_close($dbc);

        return $results;
    }

    // 录入学生的个人信息
    // 由于外键约束，要选取班号：
    // 获取该教师教授的课程： 用于后面选择对成绩的查询
    public function getClassIDs(){
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        $q = "SELECT distinct class_id  FROM ClassInfo";
        $r = mysqli_query($dbc, $q);
        if($r){
            echo '<select name="class_id">';
            while($row = mysqli_fetch_array($r)){
                var_dump($row);
                echo '<option value="'.$row['class_id'].'">'.$row['class_id'].'</option>';
            }
            echo '</select>';
        }

        mysqli_close($dbc);
    }
	
    public function recordStudentInfo($arr){
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        $insert_into = 'StudentInfo(';
        $sql_right = '';
        $update_sql_right = '';
        foreach ($arr as $key => $value) {
            if($key != 'changepwd' && $key!='submit' && $value!=''){
                $insert_into .= $key.',';
                $sql_right .= "'".$value."',";
                if($key != 'stu_id')
                    $update_sql_right .= $key."='".$value."',";
            }
        }
        // 不重置密码
        if($arr['changepwd'] == "false"){
            $insert_into = substr($insert_into, 0, strlen($insert_into)-1).')';
            $sql_right = substr($sql_right, 0, strlen($sql_right)-1).")";
            $update_sql_right = substr($update_sql_right, 0, strlen($update_sql_right)-1)." WHERE stu_id='".$arr['stu_id']."'";
        }else{
			$insert_into .= 'pwd)';
            $sql_right .= "'111111');";
            $update_sql_right .= "pwd='111111'"." WHERE stu_id='".$arr['stu_id']."'";
        }

        $q = "INSERT INTO ".$insert_into." VALUES(".$sql_right;
        //echo $q.'<br>';
        $r = mysqli_query($dbc, $q);
        if($r){
            echo $r.'添加成功';
        }
        else {
            $q = "UPDATE StudentInfo SET ".$update_sql_right;
            $r = mysqli_query($dbc, $q);
            echo $q.'<br>';
            if($r){
                echo '修改成功';
            }
            else{
                echo '修改不成功';
            }
        }

        mysqli_close($dbc);
    }

    // 录入老师的个人信息
    public function recordTeacherInfo($arr){
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');

        // 保存要插入的域的范围：
        $insert_into = 'TeacherInfo(';
        $sql_right = '';
        $update_sql_right = '';
        foreach ($arr as $key => $value) {
            if($key != 'changepwd' && $key!='submit' && $value!=''){
                $insert_into .= $key.',';
                $sql_right .= "'".$value."',";
                if($key != 'teacher_id')
                    $update_sql_right .= $key."='".$value."',";
            }
        }
        // 不重置密码
        if($arr['changepwd'] == "false"){
            $insert_into = substr($insert_into, 0, strlen($insert_into)-1).')';
            $sql_right = substr($sql_right, 0, strlen($sql_right)-1).")";
            $update_sql_right = substr($update_sql_right, 0, strlen($update_sql_right)-1)." WHERE teacher_id='".$arr['teacher_id']."'";
        }else{
            $insert_into .= 'pwd)';
            $sql_right .= "'111111');";
            $update_sql_right .= "pwd='111111'"." WHERE teacher_id='".$arr['teacher_id']."'";
        }

        $q = "INSERT INTO ".$insert_into." VALUES(".$sql_right;
        $r = mysqli_query($dbc, $q);
        if($r){
            echo $r.'添加成功';
        }
        else {
            $q = "UPDATE TeacherInfo SET ".$update_sql_right;
            $r = mysqli_query($dbc, $q);
            if($r){
                echo '修改成功';
            }
            else{
                echo '修改不成功';
            }
        }
        mysqli_close($dbc);
    }

    // 增添课程的信息
    public function addCourseInfo($arr){
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
        $q = "INSERT INTO CourseInfo VALUES('"
        .$arr['course_id']."', '"
        .$arr['course_name']."', '"
        .$arr['credit']."', '"
        .$arr['total_period']."','"
        .$arr['week_period']."', '"
        .$arr['semester']."', '"
        .$arr['year']."', '"
        .$arr['time']."', '"
        .$arr['location']."','"
		.$arr['department']."')";
        $r = mysqli_query($dbc, $q);
        if($r){
            echo '添加成功';
        }
		else echo '增加失败';
		mysqli_close($dbc);
	}
		
	// 更改课程的信息	
	public function updateCourseInfo($arr){	
		$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
		$q = "UPDATE CourseInfo SET course_name='"
            .$arr['course_name']."', credit='"
            .$arr['credit']."', total_period='"
            .$arr['total_period']."', week_period='"
            .$arr['week_period']."', semester='"
            .$arr['semester']."', year='"
            .$arr['year']."', time='"
            .$arr['time']."', location='"
            .$arr['location']."',department='"
			.$arr['department']."' WHERE course_id='"
            .$arr['course_id']."'";
            $r = mysqli_query($dbc, $q);
            if($r){
                echo '修改成功';
            }
            else{
                echo '修改不成功';
            }
			 mysqli_close($dbc);
        }
		
		//删除改课程的信息	
	public function deleteCourseInfo($arr){	
		$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
		$q = "DELETE FROM CourseInfo WHERE course_id ='".$arr['course_id']."'";
            $r = mysqli_query($dbc, $q);
           if($r){
                echo '删除成功';
            }
            else{
                echo '删除不成功';
            }
			 mysqli_close($dbc);
        }
		
	//修改密码
	public function modifyPassword($arr){
		include('conn.php');
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
		$q = "SELECT pwd from administratorinfo where admin_id = '"."$arr[admin_id]"."'";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r);
		if($row[pwd] == $arr[oldpwd] && $arr[newpwd1] == $arr[newpwd2]){
			$updateleft = "UPDATE administratorinfo SET pwd ='".$arr[newpwd1]."' ";
			$updateright = "WHERE admin_id ='".$arr[admin_id]."';";
			$q = $updateleft.$updateright;
			$r = mysqli_query($dbc, $q);
			if($r)	echo '修改成功';
			else	echo '修改失败';
		}
		else if($row[pwd] != $arr[oldpwd]){
			echo "原密码输入错误";
		}
		else{
			echo "新密码不匹配";
		}
		mysqli_close($dbc);
    }
}