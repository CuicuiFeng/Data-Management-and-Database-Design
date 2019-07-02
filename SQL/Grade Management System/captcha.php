<?php
	session_start();
	include("./phptextClass.php");	
	
	/*create class object*/
	$phptextObj = new phptextClass();	
	/*phptext function to genrate image with text*/
	$text=$phptextObj->phpcaptcha('#162453','#fff',100,30,2,10);
    //return $text;
 ?>