window.onresize = window.onload = function(){
					var w,h
					if(!!(window.attachEvent && !window.opera))
					{
						h = document.documentElement.clientHeight;
						w = document.documentElement.clientWidth;
					}else{
						h =	window.innerHeight;
						w = window.innerWidth;
					}
				var bgImg = document.getElementById('bg').getElementsByTagName('img')[0];
				bgImg.width = (w - 5);
				bgImg.height= (h-5) ;		
 				document.getElementById("bg").style.overflow="hidden";

										
			}	

function show(){ 
					var date = new Date(); 
					var now = ""; 
					now = date.getFullYear()+"-"; 
					now = now + (date.getMonth()+1)+"-"; 
					now = now + date.getDate()+"&nbsp&nbsp&nbsp&nbsp"; 
					now = now + date.getHours()+":"; 
					now = now + date.getMinutes()+":"; 
					now = now + date.getSeconds(); 
					document.getElementById("nowtime").innerHTML = now; 
					setTimeout("show()",1000); //设置过1000毫秒就是1秒，调用show方法 
			} 