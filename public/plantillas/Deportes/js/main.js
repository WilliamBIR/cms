var	cont =0,
	mouseStop = null,
	Time =45000,
	v = document.getElementById("myVideo"),
	a;

document.addEventListener("DOMContentLoaded", function(){
	v.src = ('res/video/inicio_juguetes.mp4');
    document.getElementById("menuDeportes").style.display="none";
    document.getElementById("sistemVideo").style.display="none";
    document.getElementById("myCarousel").style.display="none";
    document.addEventListener('mouseup', function(){
    	clearTimeout(mouseStop);
        mouseStop = setTimeout(playSeamlessVideo,Time);
    });
    playSeamlessVideo();
});
function playSeamlessVideo(){
    setTimeout(function(){
    	switch(cont){
        	case(1):
            	document.getElementById("menuDeportes").style.display="none";
            	break;
        	case(2):
        		document.getElementById("sistemVideo").style.display="none";
            	break;
        	case(3):
            	document.getElementById("myCarousel").style.display="none";
            	break;
            	return false;
    	}
    	document.getElementById("myVideo").style.display="block";
	},900);
    v.load();
    v.play();
    v.loop = true;
}
function showMenu(){
    v.loop =false;
    v.pause();
    document.getElementById("menuDeportes").style.display="block";
    document.getElementById("myVideo").style.display="none";
    cont=1;
}
function androidD(){
	a  = document.getElementById("sistemVideo");
	a.src = ('res/video/AndroidJuguetes.mp4');
	a.load();
	a.play();
	setTimeout(function(){ 
		document.getElementById("sistemVideo").style.display="block";
		document.getElementById("menuDeportes").style.display="none";
		cont=2;
		setTimeout(function(){
			a.pause();
		}, 17500);
	}, 1000);
}
function iosD(){
	a = document.getElementById("sistemVideo");
	a.src = ('res/video/ios-juguetes.mp4');
	a.load();
	a.play();
	setTimeout(function(){ 
		document.getElementById("sistemVideo").style.display="block";
		document.getElementById("menuDeportes").style.display="none";
		cont=2;
	}, 1000);
}
function Deportes(){
    document.getElementById("myCarousel").style.display="block";
    document.getElementById("sistemVideo").style.display="none";
    a.src='';
    cont=3;
}