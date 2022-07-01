<template>
      <borrar :link="link"></borrar>
      <form @submit.prevent="submit" id="formVid" class="form-group pt-3">
        <div class="flex justify-center flex-wrap border border-gray-300 overflow-auto max-h-100">
          <div v-for="(video, idx) in videos.data" :key="idx" :id="'video-'+idx" draggable="true" :ondragstart="DragStart" :ondragenter="DragEnter" :ondragend="DragEnd" :ondragleave="DragLeave" :class="'border border-gray-300 w-2/4 overflow-hidden flex justify-center items-center '+(show?'rounded-lg m-4':'videos-sv')">
            <div class="p-2 bg-gray-200 text-gray-500">
              <span>{{video['position'] = idx}}</span>
            </div>
            <div v-if="show" class="mx-3 w-2/6">
              <input :id="'vigencia'+idx" maxlength="8" v-on:keyup="validity" v-model="video.validity" type="number" class="form-control video-vigen" placeholder="Vigencia aaaammdd" required/>
            </div>

            <div :class="'w-full inline-block ml-2 relative ' + (show?'formauno':'formados')">
              <input type="file" :id="'archivo'+idx" @change="vinput" accept="video/mp4" class="w-0 h-0"/>
              <label :id="'larchivo'+idx" :for="'archivo'+idx" class="custom-file-label pr-18 overflow-hidden name-cv name-sv " style="text-align: center">{{video.url}}</label>
            </div>

            <a v-if="video.id!=''" @click="vdelete" :id="'data'+idx" :data-divV="idx" :data-divP="idx" :data-id="video.id" :data-name="video.name" data-toggle="modal" data-target="#delete" class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition ml-4 delete-vsv"><Trash></Trash></a>
          </div>
        </div>

        <div align="center" class="mt-5">
          <a @click.prevent="vborrar" v-if="data.number == 0" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">-</a>
          <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Guardar</button>
          <a @click.prevent="vagregar" v-if="data.number == 0" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">+</a>
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
    props:['videos','show','data'],
    data(){
      return{
        arrayVideos: new FormData(),
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
        let alert = true,vigencia=[];
        if(this.show){
          this.videos.data.forEach(v =>{
            let fecha = parseInt(`${new Date().getFullYear()}${new Date().getMonth()>8?new Date().getMonth()+1:'0'+(new Date().getMonth()+1)}${new Date().getDate()<10?'0'+new Date().getDate():new Date().getDate()}`);
            v.validity = parseInt(v.validity.toString().slice(0, 8));
            v.validity<=fecha?(alert=false,vigencia.push(v.position)):'';
          })
        }
        if(alert){
          if(this.files.length>0)
            this.files.forEach(data => {
              this.arrayVideos.append(`video${data.id}` ,data.file[0]);
            });
          this.arrayVideos.append('cantidad',Object.values(this.videos.data).length);
          this.arrayVideos.append('position',JSON.stringify(this.videos.data));

          this.$inertia.visit('/modelo/saveVideo',{
            method:'post',
            data:this.arrayVideos,
            onFinish: () => {
              document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop'));
            }
          });
          document.getElementsByTagName('body')[0].appendChild(this.div);
        }else{
          console.log('una o mas vigencias an caducado: ',vigencia);
        }
      },
      vagregar(evt){
        if(Array.isArray(this.videos.data)){
          this.videos.data.push({'id':'','name':this.videos.data.length+'.mp4','url':'Video','validity':''});
          this.videos.length = this.videos.data.length;
        }
        else
          this.videos.data[Object.values(this.videos.data).length] = {'id':'','name':Object.values(this.videos.data).length+'.mp4','url':'Video','validity':''};
      },
      vborrar(){
        if(Array.isArray(this.videos.data)){
          this.videos.data.length>1?this.videos.data.splice(this.videos.data.length-1,1):'';
          this.videos.length = this.videos.data.length;
        }
        else
          Object.values(this.videos.data).length>1?(delete this.videos.data[Object.values(this.videos.data).length-1]):'';
      },
      vdelete(e){
        e.preventDefault();
        this.link = '/video/'+e.target.dataset.id;
        var borrar = document.getElementById('borrar');
        borrar.classList.add("show");
        borrar.style.display = "block";
        document.getElementsByTagName('body')[0].appendChild(this.div);
        document.getElementsByTagName('body')[0].classList.add('modal-open');
      },
      vinput(e){
        var fileName = e.target.value.split("\\").pop(),num = parseInt(e.target.parentNode.parentNode.id.split('-')[1]);
        if(fileName!=''){
          document.getElementById('l'+e.target.id).innerHTML = fileName;
          this.files.push({id:num,file:e.target.files});
          this.videos.data[num].url = fileName;
        }
      },
      validity(e){
        if(e.target.value.length > e.target.maxLength) e.target.value = e.target.value.slice(0, e.target.maxLength);
        if(e.target.value<=`${new Date().getFullYear()}${new Date().getMonth()>8?new Date().getMonth()+1:'0'+(new Date().getMonth()+1)}${new Date().getDate()<10?'0'+new Date().getDate():new Date().getDate()}`){
          e.target.style.borderColor = 'red';return false;
        }else{
          if(e.target.value.length == 8){e.target.style.borderColor = 'green';return true;} 
        }
      },
      DragStart(evt){
        evt.dataTransfer.setData('text/plain',null);
        this.dragged.elem = evt.target;
      },
      DragEnter(evt){
        if(evt.target.id != '' && evt.target.id.indexOf('video') != -1){
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
            if(this.videos.data[id].position == file.id)
              file.id =  this.videos.data[id2].position;
            else if(this.videos.data[id2].position == file.id)
              file.id =  this.videos.data[id].position;
          });
        }
        if(this.dragged.elem2.lastChild.localName == 'a')
          this.dragged.elem2.lastChild.dataset.id = this.videos.data[id].id;
        if(this.dragged.elem2.children[1].children[1])
          this.dragged.elem2.children[1].children[1].innerHTML = this.videos.data[id].url;
        else
          this.dragged.elem2.children[2].children[1].innerHTML = this.videos.data[id].url;
        if(this.dragged.elem.lastChild.localName == 'a')
          this.dragged.elem.lastChild.dataset.id = this.videos.data[id2].id;
        if(this.dragged.elem.children[1].children[1])
          this.dragged.elem.children[1].children[1].innerHTML = this.videos.data[id2].url;
        else
          this.dragged.elem.children[2].children[1].innerHTML = this.videos.data[id2].url;
        this.DragStart(evt);
        let pos = {id:this.videos.data[id].id,validity:this.videos.data[id].validity,url:this.videos.data[id].url};
        this.videos.data[id].validity = this.videos.data[id2].validity;
        this.videos.data[id].url = this.videos.data[id2].url;
        this.videos.data[id].id = this.videos.data[id2].id;
        this.videos.data[id2].id = pos.id;
        this.videos.data[id2].validity = pos.validity;
        this.videos.data[id2].url = pos.url;
      }
    },
    mounted(){
      this.arrayVideos.append('area',this.data.area);
      this.arrayVideos.append('modelo',this.data.modelo);
      this.arrayVideos.append('det',this.data.det);
      if(Array.isArray(this.videos.data)){
        this.videos.data.length==0?this.videos.data.push({'id':'','name':'','url':'Video','validity':''}):'';
        this.videos.length = this.videos.data.length;
      }
      else
          Object.values(this.videos.data).length == 0 ? this.videos.data[Object.values(this.videos.data).length] = {'id':'','name':'','url':'Video','validity':''} :'';
      this.div.setAttribute('class','carga');
      this.div.setAttribute('id','modalBackdrop');
    },
    updated(){
      if(Array.isArray(this.videos.data)){
        this.videos.data.length==0?this.videos.data.push({'id':'','name':'','url':'Video','validity':''}):'';
        this.videos.length = this.videos.data.length;
      }
      else
          Object.values(this.videos.data).length == 0 ? this.videos.data[Object.values(this.videos.data).length] = {'id':'','name':'','url':'Video','validity':''} :'';
    }
  })
</script>