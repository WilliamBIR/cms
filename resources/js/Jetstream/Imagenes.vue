<template>
    <borrar :link="link"></borrar>
    <form @submit.prevent="submit" id="formImg" class="form-group pt-3">
        <div class="flex justify-center flex-wrap border border-gray-300 overflow-auto max-h-100">
            <div v-for="(imagen, idx) in imagenes.data" :key="idx" :id="'imagen-'+idx"  draggable="true" :ondragstart="DragStart" :ondragenter="DragEnter" :ondragend="DragEnd" :ondragleave="DragLeave" class="border border-gray-300 w-2/4 overflow-hidden flex justify-center items-center rounded-lg m-4">
                <div class="p-2 bg-gray-200 text-gray-500">
                    <span>{{imagen['position'] = idx}}</span>
                </div>
                <div class="w-full inline-block ml-2 relative">
                    <input @change="iinput" type="file" :id="'imagen'+idx" :name="'imagen'+idx" accept="image/png,image/jpeg" class="custom-file-input">
                    <label :for="'imagen'+idx" :id="'limagen'+idx" class="custom-file-label name-img" style="text-align: center;">{{imagen.url}}</label>        
                </div>
                <a v-if="imagen.id!=''" @click="idelete" :id="'data'+idx" :data-divV="idx" :data-divP="idx" :data-id="imagen.id" :data-name="imagen.name" class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition ml-4"><Trash></Trash></a>
            </div>
        </div>
        <div align="center" class="mt-5">
            <a @click="iborrar" v-if="data.number == 0" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4" style="color:white">-</a>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Guardar</button>
            <a @click="iagregar" v-if="data.number == 0" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4" style="color:white">+</a>
        </div>
    </form>
</template>
<script>
    import { defineComponent } from 'vue';
    import Borrar from '@/Jetstream/Borrar.vue';
    import Trash from '@/Jetstream/Trash.vue';

    export default defineComponent({
        components: {
            Borrar,
            Trash
        },
        props:['imagenes','data'],
        data(){
            return{
                arrayImagenes: new FormData(),
                files:[],
                link: String,
                dragged:{
                    elem:null,
                    elem2:null
                },
                div : document.createElement('div')
            };
        },
        methods:{
            submit(){
                if(this.files.length>0)
                    this.files.forEach(data => {
                        this.arrayImagenes.append(`imagen${data.id}` ,data.file[0]);
                    });
                this.arrayImagenes.append('cantidad',Object.values(this.imagenes.data).length);
                this.arrayImagenes.append('position',JSON.stringify(this.imagenes.data));

                this.$inertia.visit('/modelo/saveImage',{
                    method:'post',
                    data:this.arrayImagenes,
                    onFinish: () => {
                    document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop'));
                    }
                });
                document.getElementsByTagName('body')[0].appendChild(this.div);
            },
            iagregar(){
                if(Array.isArray(this.imagenes.data)){
                    this.imagenes.data.push({'id':'','name':'','url':'Imagenes'});
                    this.imagenes.length = this.imagenes.data.length;
                }
                else
                    this.imagenes.data[Object.values(this.imagenes.data).length] = {'id':'','name':'','url':'Imagenes'};
            },
            iborrar(){
                if(Array.isArray(this.imagenes.data)){
                    this.imagenes.data.length>1?this.imagenes.data.splice(this.imagenes.data.length-1,1):'';
                    this.imagenes.length = this.imagenes.data.length;
                }
                else
                    Object.values(this.imagenes.data).length>1?(delete this.imagenes.data[Object.values(this.imagenes.data).length-1]):'';
            },
            idelete(e){
                e.preventDefault();
                console.log('click');
                this.link = '/image/'+e.target.dataset.id;
                var borrar = document.getElementById('borrar');
                borrar.classList.add("show");
                borrar.style.display = "block";
                document.getElementsByTagName('body')[0].appendChild(this.div);
                document.getElementsByTagName('body')[0].classList.add('modal-open');
            },
            iinput(e){
                var fileName = e.target.value.split("\\").pop(),num = parseInt(e.target.parentNode.parentNode.id.split('-')[1]);
                if(fileName!=''){
                    document.getElementById('l'+e.target.id).innerHTML = fileName;
                    this.files.push({id:num,file:e.target.files});
                    this.imagenes.data[num].url = fileName;
                }
            },
            DragStart(evt){
                evt.dataTransfer.setData('text/plain',null);
                this.dragged.elem = evt.target;
            },
            DragEnter(evt){
                if(evt.target.id != '' && evt.target.id.indexOf('imagen-') != -1){
                    console.log(evt);
                    this.dragged.elem2 = evt.target;
                    this.dragged.elem.classList.remove('bg-gray-200');
                    evt.target.classList.add('bg-gray-200');
                }
            },
            DragLeave(evt){
                if(evt.target.id.indexOf('video') == -1){
                    this.dragged.elem2.classList.remove('bg-gray-200');
                }
            },
            DragEnd(evt){
                this.dragged.elem.classList.remove('bg-gray-200');
                this.dragged.elem2.classList.remove('bg-gray-200');
                let id = this.dragged.elem.id.split('-')[1]; 
                let id2 = this.dragged.elem2.id.split('-')[1];
                if(this.files.length>0){
                    this.files.forEach(file => {
                        if(this.imagenes.data[id].position == file.id)
                            file.id =  this.imagenes.data[id2].position;
                        else if(this.imagenes.data[id2].position == file.id)
                            file.id =  this.imagenes.data[id].position;
                    });
                }
                if(this.dragged.elem2.lastChild.localName == 'a')
                    this.dragged.elem2.lastChild.dataset.id = this.imagenes.data[id].id;
                if(this.dragged.elem2.children[1].children[1])
                    this.dragged.elem2.children[1].children[1].innerHTML = this.imagenes.data[id].url;
                else
                    this.dragged.elem2.children[2].children[1].innerHTML = this.imagenes.data[id].url;
                if(this.dragged.elem.lastChild.localName == 'a')
                    this.dragged.elem.lastChild.dataset.id = this.imagenes.data[id2].id;
                if(this.dragged.elem.children[1].children[1])
                    this.dragged.elem.children[1].children[1].innerHTML = this.imagenes.data[id2].url;
                else
                    this.dragged.elem.children[2].children[1].innerHTML = this.imagenes.data[id2].url;
                this.DragStart(evt);
                let pos = {id:this.imagenes.data[id].id,validity:this.imagenes.data[id].validity,url:this.imagenes.data[id].url};
                this.imagenes.data[id].validity = this.imagenes.data[id2].validity;
                this.imagenes.data[id].url = this.imagenes.data[id2].url;
                this.imagenes.data[id].id = this.imagenes.data[id2].id;
                this.imagenes.data[id2].id = pos.id;
                this.imagenes.data[id2].validity = pos.validity;
                this.imagenes.data[id2].url = pos.url;
            }
        },
        mounted(){
            this.arrayImagenes.append('area',this.data.area);
            this.arrayImagenes.append('modelo',this.data.modelo);
            this.arrayImagenes.append('det',this.data.det);
            if(Array.isArray(this.imagenes.data)){
                this.imagenes.data.length==0?this.imagenes.data.push({'id':'','name':'','url':'Imagenes'}):'';
                this.imagenes.length = this.imagenes.data.length;
            }
            else
                Object.values(this.imagenes.data).length == 0 ? this.imagenes.data[Object.values(this.imagenes.data).length] = {'id':'','name':'','url':'Imagenes'} :'';
            this.div.setAttribute('class','carga');
            this.div.setAttribute('id','modalBackdrop');
        },
        updated(){
            if(Array.isArray(this.imagenes.data)){
                this.imagenes.data.length==0?this.imagenes.data.push({'id':'','name':'','url':'Imagenes'}):'';
                this.imagenes.length = this.imagenes.data.length;
            }
            else
                Object.values(this.imagenes.data).length == 0 ? this.imagenes.data[Object.values(this.imagenes.data).length] = {'id':'','name':'','url':'Imagenes'} :'';
        }
    })
</script>
