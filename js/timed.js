

var interval = 0;
$(document).ready(function(){
	
	var timer = setInterval(reload, 60000);

	$(this).mousemove(function(e){
		interval = 0;
	});
	$(this).mousemove(function(e){
		interval = 0;
	});

	
});


function reload(){
		interval = interval+1;
		if(interval > 10){
			//alert("Session Timed Out !");
			window.location.assign('logout.php');
		} 

	}