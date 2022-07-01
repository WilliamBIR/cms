<template>
    <div @click="modal" class="modal fade bg-gray-600/25" id="enviarContenido" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-2xl select-none">Enviar Contenido</h3>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="flex justify-between items-center">
                            <label class="w-48 select-none">Actualizar: </label>
                            <select v-model="form.type" class="border-gray-300 rounded w-full">
                                <option value="sucursal">Sucursal</option>
                                <option value="grupo">Grupo</option>
                            </select>
                        </div>
                        <div v-if="form.type =='sucursal'" class="flex justify-between items-center mt-1">
                            <label class="w-44 select-none">Sucursales:</label>
                            <Multiselect v-model="form.sucu" :options="sucursales" :searchable="true" trackBy="name"
                            valueProp="id" label="name" mode="tags" class="border-gray-100 rounded w-full !ml-1"
                            noResultsText="No hay sucursales"/>
                        </div>
                        <div v-else class="flex justify-between items-center mt-1">
                            <label class="w-48 select-none">Grupos</label>
                            <select class="border-gray-200 rounded w-full" v-model="form.grupo">
                                <option v-for="grupo in grupos" :key="grupo.id" :value="grupo.name">{{grupo.name}}</option>
                            </select>
                        </div>
                        <div class="w-full text-center my-3">
                            <h4 class="text-xl select-none">Actualizacion</h4>
                        </div>
                        <div class="flex justify-between w-full flex-wrap">
                            <div :class="clase" class="min-w-[33%] sm:min-w-[23%] flex justify-between items-center p-2 border-gray-200 border-2 rounded m-1 select-none">
                                <label class="w-1/2 select-none">Completa</label>
                                <input type="radio" name="contenido" class="text-sky-500 !ring-sky-500" v-model="form.contenido" value="full">
                            </div>
                            <div v-for="cont in content" :key="cont" :class="clase" class="min-w-[33%] sm:min-w-[23%] flex justify-between items-center p-2 border-gray-200 border-2 rounded m-1 select-none">
                                <label class="w-1/2 select-none">{{cont}}</label>
                                <input type="radio" name="contenido" class="text-sky-500 !ring-sky-500" v-model="form.contenido" :value="cont">
                            </div>
                        </div>
                        <div v-if="form.type=='sucursal'">
                            <div v-if="form.sucu.length > 1" class="mt-1">
                                <div class="w-full text-center my-3">
                                    <h4 class="text-xl select-none">Guardar Grupo</h4>
                                </div>
                                <div class="flex justify-between items-center mt-1">
                                    <label class="select-none">Quieres guardar la seleccion como grupo</label>
                                    <div :class="clase" class="min-w-[33%] sm:min-w-[23%] flex justify-between items-center p-2 border-gray-200 border-2 rounded m-1 select-none">
                                        <label class="w-1/2 select-none">Si</label>
                                        <input type="radio" name="guardarGrupo" class="text-sky-500 !ring-sky-500" v-model="guardarGrupo" value="Si">
                                    </div>
                                    <div :class="clase" class="min-w-[33%] sm:min-w-[23%] flex justify-between items-center p-2 border-gray-200 border-2 rounded m-1 select-none">
                                        <label class="w-1/2 select-none">No</label>
                                        <input type="radio" name="guardarGrupo" class="text-sky-500 !ring-sky-500" v-model="guardarGrupo" value="No">
                                    </div>
                                </div>
                            </div>
                            <div v-if="guardarGrupo=='Si' && form.type=='sucursal'" class="col-lg-12 mt-3">
                                <label class="select-none">Ingresa un nombre para el nuevo grupo</label>
                                <input v-model="form.saveGrupo" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="mt-4">
                            <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Enviar
                            </jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import JetButton from '@/Jetstream/Button.vue';
import Multiselect from '@vueform/multiselect';

export default defineComponent({
    components: {
        Multiselect,
        JetButton
    },
    props:['modelo','sucursales','grupos','content', 'slug'],
    data(){
        return{
            form:{
                type: 'sucursal',
                sucu:[],
                contenido:'full',
                saveGrupo:null,
                grupo:null
            },
            guardarGrupo:'No',
            div : document.createElement('div')
        };
    },
    methods:{
        submit(){
            this.form.grupo?(this.form.saveGrupo =null,this.form.sucu = []):'';
            this.$inertia.visit('/modelo/envio',{
                method:'post',
                data:{
                    typeUpdate: this.form.type,
                    stores: this.form.sucu,
                    contentUpdate: this.form.contenido,
                    newGroup: this.form.saveGrupo,
                    group: this.form.grupo,
                    id: this.modelo.id
                },
                onBefore: this.close(),
                onFinish: ()=>{document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop'))}
            });
            document.getElementsByTagName('body')[0].appendChild(this.div);
        },
        close(){
            document.getElementsByTagName('body')[0].classList.remove("modal-open");
            document.getElementById('enviarContenido').classList.remove("show");
            document.getElementById('enviarContenido').style = "";
            document.getElementById('modalBackdrop')?document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop')):'';
            this.$inertia.socket.emit("mensaje", { uid: this.slug, message: `{"func": "actualizar"}`});
            console.log("Se envio contenido a ", this.slug);
        },
        modal(e){
            var body = document.getElementsByTagName('body')[0],ext=false, enviar = document.getElementById('enviarContenido'),modalBackdrop = document.getElementById('modalBackdrop');
            body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;})
            if(e.target == enviar){if(ext){body.classList.remove("modal-open");enviar.classList.remove("show");enviar.style = "";}if(modalBackdrop){body.removeChild(modalBackdrop)}}
        }
    },
    mounted(){
        this.div.setAttribute('class','carga');
        this.div.setAttribute('id','modalBackdrop');
    },
    computed:{
        clase(){
            let num = this.content.length + 1;
            return `w-[${(100/num)-num}%]`;
        }
    }
});
</script>