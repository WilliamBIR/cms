var localDList = 'file://internal/unzip/lista.json',
	serverDList = 'file://internal/unzip/res/lista.json',
	storage = new Storage(),
	serverList = new Object,
	localList = new Object,
	list = new Object,
	ready = false,
	cont=0,
	img = 0;

function showList(){
	document.getElementById("imagen2").src = imagenes[img];
	document.getElementById("pfijo1").innerHTML = "$"+list.pfijo1;
    document.getElementById("cfijo1").innerHTML = "."+list.cfijo1;
    document.getElementById("namefijo1").innerHTML = list.nameFijo1;

	for(i=0;i<5;i++){
		if(list.paginas[cont].hoja[i].producto!=""){
			document.getElementById("espacio"+(i+1)).style.display = "block";
			document.getElementById("articulo"+(i+1)).innerHTML = list.paginas[cont].hoja[i].producto;
			if(list.paginas[cont].hoja[i].precio.indexOf('x')!=-1){
				var precio = list.paginas[cont].hoja[i].precio.split('x');
				document.getElementById("precio"+(i+1)).innerHTML = "<FONT SIZE=4  style='letter-spacing: -5px;font-size:50px;'>"+precio[0]+' x $'+precio[1]+"</font>";
			}else
				document.getElementById("precio"+(i+1)).innerHTML = "$"+list.paginas[cont].hoja[i].precio;
			document.getElementById("centavos"+(i+1)).innerHTML = "."+list.paginas[cont].hoja[i].centavo;
		}
		else
			document.getElementById("espacio"+(i+1)).style.display = "none";
	}
	ready = true;
	cont++;
	img++;
	if(img===imagenes.length){
		img=0;
	}
    if(cont===parseInt(list.page)){
    	cont = 0;
    }
    setTimeout(function(){ ready = false; },9000);
    setTimeout(function(){ showList(); },11000);	
}

function checarLista(){
	console.log('Aplicacion de Pescados');
	setInterval(function(){ validarLista(); },180000);
	storage.readFile(function(res){
		localList = JSON.parse(res.data);
		list = localList;
		showList();
	},function(rej){
		storage.copyFile(function (res){
			storage.readFile(function(res){
				localList = JSON.parse(res);
				showList();
			},function(rej){errorList(rej)},{path:localDList});
		},function(rej){errorList(rej)},{source:DOWNLOAD_JSON,destination:localDList});	
	},{path:localDList,position : 0,length : 10240,encoding : 'utf8'});	
}

function validarLista(){
	storage.copyFile(function (res){
		storage.readFile(function(res){
			serverList = JSON.parse(res.data);
			if (localList.fecha+localList.hora < serverList.fecha+serverList.hora) {
				storage.copyFile(function (res){
					console.log("Lista de Precios Actualizada");
					changeList();
				},function(rej){errorList(rej)},{source:serverDList,destination:localDList});
			}else{
				console.log("La Lista de precios ya esta actualizada.")
			}
		},function(rej){errorList(rej)},{path:serverDList,position : 0,length : 10240,encoding : 'utf8'});
	},function(rej){errorList(rej)},{source:DOWNLOAD_JSON,destination:serverDList});
}

function changeList(){
	if(ready){
		list = localList = serverList;
	}else{
		setTimeout(function(){ changeList(); },2000);
	}
}

function errorList(msg){
	console.log(msg);
}