var localDList = 'file://internal/unzip/lista.json',
	serverDList = 'file://internal/unzip/res/lista.json',
	storage = new Storage(),
	serverList = new Object,
	productos = new Object,
	localList = new Object,
	list = new Object,
	ready = false,
	pagina = 0,
	cont=0;


function showList(){
	if(document.getElementById("header").style.backgroundImage != 'url(file:///media/cryptofs/apps/usr/palm/applications/com.lg.app.signage/content/unzip/res/img/extra.png)' && document.getElementById("header").style.backgroundImage != 'url("res/img/extra.png")'&& document.getElementById("header").style.backgroundImage != "url('res/img/extra.png')"){
		if(list.paginas[cont].hoja[0].producto != ""){
			list = localList;
			pagina = parseInt(list.page);
			productos = list.paginas[cont];
		}else{
			document.getElementById("header").style.backgroundImage = "url('res/img/extra.png')";
			pagina = parseInt(list.extra);
			productos = list.plus[cont];
		}
	}
	else{
		pagina = parseInt(list.extra);
		productos = list.plus[cont];
	}
	for(i=0;i<8;i++){
		if(productos.hoja[i].producto!=""){
			document.getElementById("espacio"+(i+1)).style.display = "block";
			document.getElementById("articulo"+(i+1)).innerHTML = productos.hoja[i].producto;
			if(productos.hoja[i].centavo!=""){
				document.getElementById("centavos"+(i+1)).style.display = "flex";
				document.getElementById("centavos"+(i+1)).innerHTML = productos.hoja[i].centavo;
			}
			else
				document.getElementById("centavos"+(i+1)).style.display = "none";
			if(productos.hoja[i].precio!=""){
				document.getElementById("precio"+(i+1)).style.display = "flex";
				document.getElementById("precio"+(i+1)).innerHTML = productos.hoja[i].precio;
			}
			else
				document.getElementById("precio"+(i+1)).style.display = "none";
		}else
		document.getElementById("espacio"+(i+1)).style.display = "none";
	}
	ready = true;
	cont++;
    if(cont===pagina){
    	cont = 0;
    	setTimeout(function(){ ready = false; },9000);
    	if(document.getElementById("header").style.backgroundImage != 'url(file:///media/cryptofs/apps/usr/palm/applications/com.lg.app.signage/content/unzip/res/img/extra.png)' && document.getElementById("header").style.backgroundImage != 'url("res/img/extra.png")' && document.getElementById("header").style.backgroundImage != "url('res/img/extra.png')"){
			if(list.hasOwnProperty("plus")){
				if(list.plus[0].hoja[0].producto != ""){
					setTimeout(function(){ 
						document.getElementById("header").style.backgroundImage = "url('res/img/extra.png')";
						showList();
					},11000);
				}else{
					setTimeout(function(){ showList(); },11000);
				}
			}else{
				setTimeout(function(){ showList(); },11000);
			}
    	}
    	else{
    		setTimeout(function(){ 
    			document.getElementById("header").style.backgroundImage = "url('res/img/precios.png')";
    			showList();
    		},11000);
    	}
    }else{
    	setTimeout(function(){ ready = false; },9000);
    	setTimeout(function(){ showList(); },11000);
    }
}

function checarLista(){
	console.log('Aplicacion de Bebidas Calientes 2');
	setInterval(function(){ validarLista(); },180000);
	storage.readFile(function(res){
		localList = JSON.parse(res.data);
		list = localList;
		pagina = parseInt(list.page);
		showList();
	},function(rej){
		storage.copyFile(function (res){
			storage.readFile(function(res){
				localList = JSON.parse(res);
				pagina = parseInt(list.page);
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