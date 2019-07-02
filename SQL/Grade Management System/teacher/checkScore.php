<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div style="color:white">
<?php
session_start();
if(!isset($_SESSION['teacher_id'])){
    header("Location: ../index.php");
}
include "../models/teacherService.class.php";
$ts = new teacherService();
$results = $ts->getTeachCourses($_SESSION['teacher_id']);
?>

<form name="course_name" method="post" action="">



<?php
if($_SERVER['REQUEST_METHOD']  == 'POST'){
    $ts = new teacherService();
    $re = $ts->checkScore($_POST[select]);
	$rows = count($re,0);
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
<div>
<body>
    <table id="table" width="90%" border="1px" cellspacing="0px" cellpadding="15px">
        <tr style="font-size: 1.5em ">
            <td><font face="微软雅黑">课程号</font></td>
            <td><font face="微软雅黑">学号</font></td>
            <td><font face="微软雅黑">学生</font></td>
            <td><font face="微软雅黑">成绩</font></td><br/>
        </tr>
        <?php
            for($i=0;$i<$rows;$i++){
                ?>
                <tr>
                    <td><?php echo $re[$i]["course_id"] ?></td>
                    <td><?php echo $re[$i]["stu_id"] ?></td>
                    <td><?php echo $re[$i]["stu_name"] ?></td>
                    <td><?php echo $re[$i]["grade"] ?></td><br/>
                </tr>
       <?php
            }
        ?>

    </table>
</body>
</html>


<div id="box1" style="width: 100%; height: 15%; margin-top:270px;">     <! 图表canvas >
            <canvas id="bar"></canvas>
            </br>
            <p style="text-align:center">成绩统计饼状图</p>
            <canvas id="pie"></canvas> 
</div>


<?php
	$data1 = 0; $data2 = 0; $data3 = 0; $data4 = 0; $data5 = 0;
    foreach($re as $r){
      if($r['grade']<60)
        $data1++;
      elseif (60<=$r['grade'] && $r['grade']<70) 
        $data2++;
      elseif (70<=$r['grade'] && $r['grade']<80) 
        $data3++;
      elseif (80<=$r['grade'] && $r['grade']<90) 
        $data4++;
      elseif (90<=$r['grade'] && $r['grade']<100) 
        $data5++;
	}
	$data = array($data1,$data2,$data3,$data4,$data5);
    $str = json_encode($data);
	
?>




<?php	
}

	else{ ?>
 	<table width="280" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="80" height="20" align="center"><span class="style2">课程选择：</span></td>
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
<?php }
?>


<script>
      var str = '<?=$str?>'
      var arr = JSON.parse(str);

      var ctx = document.getElementById("bar");
      var data = {                      
                labels: ["不及格", "60-70", "70-80", "80-90", "90-100"],//统计的分数段
                datasets: [
                        {
                          label: "成绩统计柱状图",
                          backgroundColor: "rgba(255,99,132,0.2)",
                          borderColor: "rgba(255,99,132,1)",
                          borderWidth: 1,
                          hoverBackgroundColor: "rgba(255,99,132,0.4)",
                          hoverBorderColor: "rgba(255,99,132,1)",
                          data: arr,//各分数段数据 复用时只用编辑这个!!
                        }
                      ]
            }
      
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
                scales: {
                  yAxes: [{
                      ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

      var ctx = document.getElementById("pie");
      var data = {
                labels: ["不及格","60-70","70-80","80-90","90-100"],
                datasets: [
                      {
                            data:arr,//复用时只用修改
                            backgroundColor: ["#FF6384","#36A2EB","#FFCE56","#8E8E38","#228B22"],
                          hoverBackgroundColor: ["#FF6384","#36A2EB","#FFCE56","8E8E38","228B22"]
                         }]
                };
        var mychart=new Chart(ctx,{
              type:"pie",
              data:data,
              options: {
                     responsive: true
                    }
              });
</script>
</body>
</html>
</div>

