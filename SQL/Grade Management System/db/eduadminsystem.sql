drop database EduAdminSystem if exists EduAdminSystem;

create database EduAdminSystem;

use EduAdminSystem;

create table ClassInfo(
	class_id varchar(20),
	class_type varchar(20),
	department varchar(20),
	primary key(class_id))
	DEFAULT CHARSET=utf8;

create table StudentInfo(
	stu_id varchar(20),
	stu_name varchar(20),
	sex char(5),
	bdate date,
	class_id varchar(20),
	extrance_date date,
	home_town varchar(10),
	pwd varchar(20),
	primary key(stu_id),
	foreign key(class_id) references ClassInfo)
	DEFAULT CHARSET=utf8;

create table TeacherInfo(
	teacher_id varchar(20),
	teacher_name varchar(20),
	sex char(5),
	bdate date,
	department varchar(20),
	profession varchar(20),
	phone varchar(20),
	home_addr varchar(50),
	email varchar(50),
	pwd varchar(20),
	primary key(teacher_id))
	DEFAULT CHARSET=utf8;
	
create table CourseInfo(
	course_id varchar(20),
	course_name varchar（20），
	credit numeric(2,1),
	total_period numeric(2,0),
	week_period numeric(1,0),
	semester varchar(20),
	year varchar(10),
	time varchar(20),
	location varchar(20),
	department varchar(20),
	primary key(course_id))
	DEFAULT CHARSET=utf8;

create table StudentCourse(
	stu_id varchar(20),
	course_id varchar(20),
	grade float,
	primary key(stu_id,course_id),
	foreign key(stu_id) references StudentInfo,
	foreign key(course_id) references CourseInfo)
	DEFAULT CHARSET=utf8;

create table TeacherCourse(
	teacher_id varchar(20),
	course_id varchar(20),
	primary key(teacher_id,course_id),
	foreign key(stu_id) references TeacherInfo,
	foreign key(course_id) references CourseInfo))
	DEFAULT CHARSET=utf8;

create table AdministratorInfo(
	admin_id varchar(20),
	pwd varchar(20),
	primary key(admin_id))
	DEFAULT CHARSET=utf8;

insert into AdministratorInfo values('admin1',md5('123456')),
				    ('admin2',md5('123456'));

insert into ClassInfo values
('2014211301','计算机科学与技术','计算机学院'),
('2014211302','计算机科学与技术','计算机学院'),
('2014211303','计算机科学与技术','计算机学院'),
('2014211304','计算机科学与技术','计算机学院');

insert into StudentInfo values
('2014211196','孟老灰','男',1996-4-14,'2014211303',2014-9-7,'山东','123456'),
('2014211199','周杰','男',1996-2-14,'2014211303',2014-9-7,'安徽','123456'),
('2014211211','甄晓妹','女',1996-1-21,'2014211301',2014-9-7,'湖北','123456'),
('2014211196','徐小雄','男',1996-9-1,'2014211302',2014-9-7,'福建','123456'),
('2014211196','郭雯妲','男',1996-8-7,'2014211304',2014-9-7,'湖南','123456'),
('2014211196','全二炮','男',1996-12-20,'2014211303',2014-9-7,'江西','123456');

insert into TeacherInfo values
('12345','肖丁','男','1968-11-9','计算机学院','软件工程','15867644234','北京','a272726521@163.com','pwd是什么');

insert into CourseInfo values
('54321','计算机体系结构',1,3,3,'春','2017','08:00-10:00','教4-444','计算机学院');