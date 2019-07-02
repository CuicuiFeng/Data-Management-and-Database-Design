<?php
/**
* teacherService.class.php: 提供对teacher表的各种操作
*/


class teacherService
{

    function __construct()
    {
        # code...
    }

    // 查询教师个人信息
    public function checkInfo($tid){    // 使用 教师id 作为参数
        include('conn.php');

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

    // 获取该教师教授的课程： 用于后面选择对成绩的查询
    public function getTeachCourses($tid){
        include('conn.php');
        $results = array();

        $q = "SELECT course_id,course_name FROM teachercourse natural join courseinfo WHERE teacher_id='$tid'";
        $r = mysqli_query($dbc, $q);
        if($r){
            while($row = mysqli_fetch_array($r)){
                $results[] = $row;
            }
        }else{
            echo '无此ID的教师';
        }
        return $results;
    }
	


    // 获取该教师教授的课程： 用于后面选择对成绩的查询
    /*public function getTeachCourses2($tid){
        include('conn.php');
        $results = array();

        $q = "SELECT distinct CourseInfo.course_id,course_name  FROM TeacherCourse,CourseInfo WHERE teacher_id='$tid' and CourseInfo.course_id=TeacherCourse.course_id";
        $r = mysqli_query($dbc, $q);
        if($r){
            while($row = mysqli_fetch_array($r)){
                $qt = "SELECT student_id FROM StudentCourse WHERE course_id='".$row['course_id']."'";
                $rt = mysqli_query($dbc, $qt);
                $rest = array();
                if($qt){
                    while ($rowt = mysqli_fetch_array($rt)) {
                        $rest[] = $rowt;
                    }
                    $results[] = array("course"=>$row, "students"=>$rest);
                }
            }
        }else{
            echo '无此ID的教师';
        }
        return $results;
    }*/

     public function getStudentIDs($cid){
         include_once('conn.php');
         // [hostname包括端口号，默认为3306], [username], [password]
         $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
         // set encoding:
         mysqli_set_charset($dbc, 'utf8');

         $results = array();

         $q = "SELECT stu_id FROM StudentCourse WHERE course_id='$cid'";
         $r = mysqli_query($dbc, $q);
         if($r){
             while($row = mysqli_fetch_array($r)){
                 $results[] = $row;
             }
         }else{
             echo '无此ID的教师';
         }
        return $results;
     }

 
    public function checkScore($course_id){ // 使用课程号作为参数
        include_once('conn.php');
        if(!isset($dbc)){
            // [hostname包括端口号，默认为3306], [username], [password]
            $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
            // set encoding:
            mysqli_set_charset($dbc, 'utf8');
        }

        $results = array();

        $q = "SELECT * FROM StudentCourse natural join studentinfo WHERE course_id='$course_id'";
        $r = mysqli_query($dbc, $q);
        if($r)
            while($row = mysqli_fetch_array($r)){
                $results[] = $row;
            }
        else{
            echo '无此ID的课程';
        }

        mysqli_close($dbc);

        return $results;
    }

    // 录入成绩
    /*public function recordScore($course_id, $stu_id, $stu_score){
        include_once('conn.php');
        if(!isset($dbc)){
            // [hostname包括端口号，默认为3306], [username], [password]
            $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
            // set encoding:
            mysqli_set_charset($dbc, 'utf8');
        }

        $results = '';
        $q = "SELECT grade FROM StudentCourse WHERE course_id='$course_id' and student_id='$stu_id'";
        $r = mysqli_query($dbc, $q);
        if($r){
            $row = mysqli_fetch_array($r);
            if($row['grade'] == null || $row['grade'] == 0 || $row['grade']==''){
                $results = 'can go here!'.$course_id.$stu_id.$stu_score;
                $qt = "UPDATE StudentCourse SET grade='$stu_score' WHERE course_id='$course_id' and student_id='$stu_id'";
                $rt = mysqli_query($dbc, $qt);
                if($rt)
                    $results .= '录入成功';
            }else{
                $results = '已存在该学生的成绩信息，录入失败';
            }
        }else{
            $results = '已存在该学生的成绩信息，insert失败';
        }

        mysqli_close($dbc);

        return $results;
    }*/

    // 修改成绩
    public function modifyScore($course_id, $stu_id, $stu_score){
        include_once('conn.php');
        if(!isset($dbc)){
            // [hostname包括端口号，默认为3306], [username], [password]
            $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
            // set encoding:
            mysqli_set_charset($dbc, 'utf8');
        }
        $q = "UPDATE StudentCourse SET grade='$stu_score' WHERE stu_id='$stu_id' AND course_id='$course_id'";
        $r = mysqli_query($dbc, $q);
        if($r){
            // while($row = mysqli_fetch_array($r)){
            //     var_dump($row);
            // }
            echo '修改成功';
        }else{
            echo '不存在该学生的成绩信息，update失败';
        }

        mysqli_close($dbc);
    }
	
	//修改密码
	public function modifyPassword($arr){
		include('conn.php');
        $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
        mysqli_set_charset($dbc, 'utf8');
		$q = "SELECT pwd from teacherinfo where teacher_id = '"."$arr[teacher_id]"."'";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r);
		if($row[pwd] == $arr[oldpwd] && $arr[newpwd1] == $arr[newpwd2]){
			$updateleft = "UPDATE teacherinfo SET pwd ='".$arr[newpwd1]."' ";
			$updateright = "WHERE teacher_id ='".$arr[teacher_id]."';";
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

