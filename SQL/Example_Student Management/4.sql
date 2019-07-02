use assign_temp;

/*查询“数据库原理”课程的学分；*/
/*select credit
from course
where  course_name='数据库原理'*/
/*查询选修了课程编号为“C01”的学生的学号和成绩，并将成绩按降序输出；*/
/*select student_id,score
from sc
where course_id='C01'
order by score desc;*/
/*查询学号为“31401”的学生选修的课程编号和成绩；*/
/*select course_id,score
from sc 
where student_id=31401;*/
/*查询选修了课程编号为“C01”且成绩高于85分的学生的学号和成绩。*/
/*select student_id ,score
from sc 
where course_id='C01' and score >85;*/

/*查询选修了课程编号为“C01”且成绩高于85分的学生的学号、姓名和成绩；*/
/*select sc.student_id ,student_name,score
from sc,student 
where sc.course_id ='C01' 
      	 and sc.student_id =student.student_id 
     and sc.score >85;*/
/*查询所有学生的学号、姓名、选修的课程名称和成绩；*/
/*select sc.student_id,student_name,course_name,score
from sc,student,course 
where sc.student_id =student.student_id 
      and sc.course_id =course.course_id ;*/
      
 /*查询至少选修了三门课程的学生的学号和姓名；*/     
/*select sc.student_id,student.student_name,COUNT(sc.course_id )
from sc,student 
where sc.student_id =student.student_id 
group by sc.student_id,student_name 
having COUNT(sc.course_id )>=3;*/

/*3.2*/
/*select student_id,max(score ) as max_score
from sc
group by student_id having min(score)>0;*/
/*查询所有学生的学号和他选修课程的最高成绩，要求他的选修课程中没有成绩为空的。
select sc .student_id,student_name,max(score ) as max_score
from sc,student
where sc.student_id in
((select sc .student_id
from sc,student 
where sc.student_id =student.student_id)
except
(select sc .student_id
from sc,student 
where sc.student_id =student.student_id and score is NULL))
and sc.student_id =student.student_id
group by sc .student_id,student_name*/

/*查询选修了数据库原理的学生的学号和姓名；*/
/*select student_id ,student_name 
from student
where student_id in
     (select student_id
     from sc,course
     where sc.course_id =course.course_id 
     and course_name='数据库原理'
     );*/
/*查询没有选修数据库原理的学生的学号和姓名；*/
/*select student_id ,student_name 
from student
where student_id not in
     (select student_id
     from sc,course
     where sc.course_id =course.course_id 
     and course_name='数据库原理'
     );*/
/**/
/*4.3查询至少选修了学号为“31401”的学生所选修的所有课程的学生的学号和姓名。
采用视图实现*/
create view elct
as select distinct course_id from sc 
where student_id='31403';
create view telct 
as select elct.course_id,student_id 
from elct left join sc 
on elct.course_id=sc.course_id;
select student_id,student_name 
from student 
where student_id in
(select student_id 
 from telct
  group by student_id 
  having count(distinct course_id)=3);
  
/*select student_id ,student_name 
from student as S
where not exists(
     (select course_id 
     from sc
     where sc.student_id =31401)
     except－－－－－－－－－－－－－－－－－－－－－不支持
     (select course_id 
     from sc as T ,student as R 
     where T.student_id =R.student_id
     and S.student_name=R.student_name )
);*/

/*视图编辑*/
/*create view studentview 
as (select student.student_id,student.student_name,dept,course.course_id,course.course_name,score 
from student,course,sc 
where student.student_id=sc.student_id and sc.course_id=course.course_id);*/
/*查询选修了课程编号为“C01”的学生的学号和成绩；*/
/*select student_id,student_name
from studentview
where course_id='C02';*/
/*查询所有学生的学号、姓名、选修的课程名称和成绩；*/
/*select student_id,student_name,course_id,score
from studentview;*/
/*查询选修了数据库原理的学生的学号和姓名。*/
/*select student_id,student_name,course_name
from studentview
where course_name='数据库原理';*/

/*实验二中部分数据更新*/
/*UPDATE `assign_temp`.`student` SET `course_id`='3146' WHERE `student_id`='32222';
INSERT INTO `assign_temp`.`course` (`course_id`, `course_name`, `lhour`, `credit`) VALUES ('c06', '信息安全', '30', '2');
select * from course;*/
/*UPDATE `assign_temp`.`course` SET `credit`='4' WHERE `course_id`='C02';
select * from course*/
/*UPDATE `assign_temp`.`sc` SET `score`='50' WHERE `student_id`='31402' and`course_id`='C01';
select * from sc;*/
/*delete from student where student_id=33333;
select * from student;*//*update assign_temp.course 
set credit='102'
where course_id='C02'; */                         /*数字和字符的单引号不同*/
/*select * from course;*/







