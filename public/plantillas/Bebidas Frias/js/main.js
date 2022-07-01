var localDList = 'file://internal/unzip/lista.json',
	serverDList = 'file://internal/unzip/res/lista.json',
	storage = new Storage(),
	serverList = new Object,
	localList = new Object,
	list = new Object,
	ready = false,
	cont=0;

function showList(){
	for(i=0;i<6;i++){
		if(list.paginas[cont].hoja[i].producto.indexOf('(')!=-1){
			var producto = list.paginas[cont].hoja[i].producto.split('(');
			document.getElementById("articulo"+(i+1)).innerHTML = producto[0]+'<span>&nbsp;('+producto[1]+'</span>';
		}else
		if(list.paginas[cont].hoja[i].producto!=""){
			document.getElementById("espacio"+(i+1)).style.display = "block";
			document.getElementById("articulo"+(i+1)).innerHTML = list.paginas[cont].hoja[i].producto;
			document.getElementById("precio"+(i+1)).innerHTML = "$"+list.paginas[cont].hoja[i].precio;
			document.getElementById("centavo"+(i+1)).innerHTML = "."+list.paginas[cont].hoja[i].centavo;
		}
		else
			document.getElementById("espacio"+(i+1)).style.display = "none";
	}
	ready = true;
	cont++;
	
	if(cont===parseInt(list.page)){
		cont = 0;
		setTimeout(function(){ ready = false; },9000);
	}
	setTimeout(function(){ showList(); },11000);
}

function checarLista(){
	setInterval(function(){ validarLista(); },180000);
	console.log('Aplicacion de Bebidas Frias');
	storage.readFile(function(res){
		localList = JSON.parse(res.data);
		list = localList;
		showList();
	},function(rej){
		console.log('');
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
			}
			else {
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