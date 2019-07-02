<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 2016/7/7
 * Time: 15:03
 */
// 设置cookie保存用户名和密码，供粘性表单使用：

session_start();
include_once("./models/conn.php");

if(isset($_GET['submit'])){
    // code for check server side validation
    if(isset($_GET['userId']) and isset($_GET['password']) and isset($_GET['type'])){
        setcookie('userId', $_GET['userId']);
        setcookie('password', $_GET['password']);
        setcookie('type', $_GET['type']);

        //信息未填写完整时
        if($_GET['type']=="" or $_GET['password']=="" or $_GET['userId']==""){
            $msg = "请填写完整信息!";
            header("Location: ./index.php?msg=$msg");
            exit();
        }
        else{
            $type = $_GET['type'];
            $id = $_GET['userId'];
            $password = ($_GET['password']);
			
            if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_GET['captcha_code']) != 0){
                $msg="验证码不匹配!";
                header("Location: ./index.php?msg=$msg");
            }else {
                $msg = "验证码匹配";
                if ($id != "" and $password != "" and $type != "") {
                    switch ($type) {
                        case "student":
                            verifyStudent($dbc, $id, $password);
                            break;
                        case "teacher":
                            verifyTeacher($dbc, $id, $password);
                            break;
                        case "admin":
                            verifyAdmin($dbc, $id, $password);
                            break;
                        default:
                            break;
                    }
                } else {
                    $msg = "<span style='color:red'>请填写完整信息!</span>";
                    header("Location: ./index.php?msg=$msg");
                }
            }
        }
    }
    else {
        echo "少年！请先<a href='index.php'>登陆</a>！";
    }
}

function verifyStudent($dbc,$id,$password)
{
    $sql = "select * from StudentInfo where stu_id = '".$id."' and pwd = '".$password."'";

    if($result = mysqli_query($dbc,$sql))
    {
        if($result->num_rows > 0){
            mysqli_free_result($result);
            $url = "./student/student.php";
            $_SESSION['student_id'] = $id;
            echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
        }
        else {
            header("Location:index.php?errno=1");
            exit();
        }
    }
    else{
        header("Location:index.php?errno=1");
        exit();
    }
}

function verifyTeacher($dbc,$id,$password)
{
    $sql = "select * from TeacherInfo where teacher_id =  '".$id."' and pwd = '".$password."'";
    if($result = mysqli_query($dbc,$sql))
    {
        if($result->num_rows > 0){
            mysqli_free_result($result);
            $url = "./teacher/teacher.php";
            $_SESSION['teacher_id'] = $id;
            echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
        }
        else {
            header("Location:index.php?errno=1");
            exit();
        }
    }else{
        header("Location:index.php?errno=1");
        exit();
    }
}

function verifyAdmin($dbc,$id,$password)
{
	$sql = "select * from AdministratorInfo where admin_id = '".$id." ' and pwd = '".$password."'";
    if($result = mysqli_query($dbc,$sql))
    {
        if($result->num_rows > 0){
            mysqli_free_result($result);
            $url = "./admin/admin.php";
            $_SESSION['admin_id'] = $id;
            echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
        }
        else {
            header("Location:index.php?errno=1");
            exit();
        }
    }
}