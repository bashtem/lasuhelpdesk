var xmlHttp;
//method return a XMLHttpRequest Object
function getXMLHttpRequest(){
	var xmlHttp=null;
	try{// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	}catch(e){
		try{ // Internet Explorer
    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
   		 }catch(e){
   			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
   		 }
	}
	return xmlHttp;
}

/*function regservice(){
xmlHttp = getXMLHttpRequest();

	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return false;
	}
	
	var url="service/new_service.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("portal").innerHTML=xmlHttp.responseText;
		}else if(xmlHttp.readyState==3){
			document.getElementById("portal").innerHTML="Loading...";
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}*/

/*
function checkexist(){
var email = document.getElementById('email').value.trim();

xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="checkexist.php?email="+email;
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("others").innerHTML=xmlHttp.responseText;
			
						
		}else if(xmlHttp.readyState==3){
			document.getElementById("others").innerHTML="Loading...";
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}
*/



function reqnew(){

xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="panel_req.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("change").innerHTML=xmlHttp.responseText;
		}else{
			document.getElementById("change").innerHTML='<center><img  src="fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}

function requests(){


xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="requests.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("change").innerHTML=xmlHttp.responseText;
		}else{
			document.getElementById("change").innerHTML='<center><img  src="fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}


function pages(data){

//alert("yess");
xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="requests.php?page="+data;
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("change").innerHTML=xmlHttp.responseText;
		}else{
			document.getElementById("change").innerHTML='<center><img  src="fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}



function view_profile(){


xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="profile.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("change").innerHTML=xmlHttp.responseText;
		}else{
			document.getElementById("change").innerHTML='<center><img  src="fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}


function forget(){
xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	
	var url="../forgot.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			//document.getElementById("portal").innerHTML="";
			var node = xmlHttp.responseText;
			$("#portal").hide();
			$("#portal").html(node);
			$("#portal").fadeIn(3000);
		}else{
			document.getElementById("portal").innerHTML='<center><img  src="fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}

function passcheck(){
document.getElementById("incorrect").innerHTML="<span style='color:red'>Incorrect Login Details?</span>";
}



