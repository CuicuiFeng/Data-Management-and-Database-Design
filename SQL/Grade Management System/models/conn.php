<?php
// 数据库链接文件
define('DB_USER', 'root');
define('DB_PASSWORD', 'nn4mfgva');
define('DB_HOST', 'localhost');
define('DB_NAME', 'eduas');

// [hostname包括端口号，默认为3306], [username], [password]
$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("不能链接到数据库服务器".mysqli_connect_error());
// set encoding:
mysqli_set_charset($dbc, 'utf8');

// 系统定义的常量
// echo "<br>当前文件路径: ".__FILE__;
// echo "<br>当前行数： ".__LINE__;
// echo "<br>当前php版本信息： ".PHP_VERSION;
// echo "<br>当前操作系统： ".PHP_OS;
