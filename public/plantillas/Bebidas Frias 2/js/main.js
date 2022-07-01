var serverDList = 'file://internal/unzip/res/lista.json',
    localDList = 'file://internal/unzip/lista.json',
    precios = document.getElementsByClassName("precios")[0],
    serverList = new Object,
    localList = new Object,
    storage = new Storage(),
    lista = new Object,
    list = new Object,
    ready = false,
    type = true,
    pagina = 0,
    object;

function showList(){
    if(type){
        precios.classList.remove('extra');
        precios.classList.add('mktsd');
        lista = list.paginas[pagina].hoja;
        var comp = list.paginas;
    }else{
        precios.classList.remove('mktsd');
        precios.classList.add('extra');
        lista = list.plus[pagina].hoja;
        var comp = list.extra;
    }
    precios.innerHTML = '';
    lista.forEach((articulo,id) => {
        var div = document.createElement('div');
        div.setAttribute('id','espacio'+id);
        div.setAttribute('class','espacio');
        var p = document.createElement('p');
        p.setAttribute('id','precio'+id);
        p.setAttribute('class','money');
        var a = document.createElement('p');
        a.setAttribute('id','articulo'+id);
        a.setAttribute('class','articulo');
        if(articulo.producto == "")
            div.style.display = 'none';

        if(articulo.producto.indexOf('(')!=-1){
            var producto = articulo.producto.split('(');
            a.innerHTML = producto[0]+'<span>&nbsp;('+producto[1]+'</span>';
        }else
            a.innerHTML = articulo.producto;
        if(articulo.precio.indexOf('.')!=-1){
            var precio = articulo.precio.split('.');
            p.innerHTML = precio[0]+'<span>.'+precio[1]+'</span>';
        }else
            p.innerHTML = articulo.precio;
        div.appendChild(a);
        div.appendChild(p);
        precios.appendChild(div);
    });
    ready = true;
    pagina=pagina+1;
    if(pagina==comp.length){
        type = type?false:true;
        pagina = 0;
        setTimeout(function(){ready=false},9000)
    }
    setTimeout(function(){showList();},11000)
}

function checarLista(){
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