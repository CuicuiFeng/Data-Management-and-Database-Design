<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 2016/7/8
 * Time: 18:53
 */
include_once('conn.php');
class studentService
{
    function __construct()
    {
        # code...
    }

    // 查询学生个人信息
    public function checkInfo($sid){    // 使用 学生id 作为参数

        include('conn.php');
        $q = "SELECT DISTINCT * FROM StudentInfo WHERE stu_id='$sid'";
        $r = mysqli_query($dbc, $q);

        $row = null;
        if($r){
            if(mysqli_num_rows($r) > 0)
              $row = mysqli_fetch_all($r,MYSQLI_BOTH);
        }
        return $row;
    }


    // 查询成绩
    public function checkScore($student_id){
        include_once('conn.php');
        if(!isset($dbc)){
            $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
            mysqli_set_charset($dbc, 'utf8');
        }

        $q = "SELECT course_id,course_name,credit,grade FROM studentcourse natural join studentinfo natural join courseinfo WHERE stu_id='$student_id'";
        $r = mysqli_query($dbc, $q);

        $row = null;
        if($r){
            if(mysqli_num_rows($r) > 0)
                $row = mysqli_fetch_all($r,MYSQLI_BOTH);
        }
        mysqli_close($dbc);
        return $row;
    }

    public function modifyPassword($arr){
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
		$q = "SELECT pwd from studentinfo where stu_id = '"."$arr[stu_id]"."'";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
		if($row[pwd] == $arr[oldpwd] && $arr[newpwd1] == $arr[newpwd2]){
			$updateleft = "UPDATE studentinfo SET pwd ='".$arr[newpwd1]."' ";
			$updateright = "WHERE stu_id ='".$arr[stu_id]."';";
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
