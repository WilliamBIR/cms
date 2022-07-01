<template>
    <div @click="modal" class="modal fade bg-gray-600/25" id="addModelo" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Departamento</h5>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" class="form-group">
                        <div class="form-group">
                            <label>Nombre</label>
                            <select class="form-control" v-model="form.name" name="name" required>
                                <option v-for="mod in modelos" :key="mod.id" :value="mod.name">{{mod.name}}</option>
                            </select>
                        </div>
                        <div class="form-group" align="center">
                            <label v-if="area.store=='walmart'"><h5>Determinante: {{area.det}}</h5></label>
                        </div>
                        <div class="mt-4">
                            <jet-button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Crear
                            </jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import JetButton from '@/Jetstream/Button.vue'

export default {
    components: {
        JetButton
    },
    props:['modelos','area'],
    data(){
        return{
            form:{
                name:"",
                det:this.area.det,
                id:this.area.id
            },
            submitBolean: true,
            div : document.createElement('div')
        };
    },
    methods:{
        submit(){
            if(this.submitBolean){
                Inertia.post('/area/create',
                {
                    name: this.form.name,
                    det: this.form.det,
                    id: this.form.id
                },{
                    onStart:()=>{this.submitBolean = false},
                    onError: errors => {this.$page.props.flash.error = errors;console.log(errors)},
                    onFinish: () => {this.close(),this.submitBolean = true},
                });
                
                document.getElementsByTagName('body')[0].appendChild(this.div);
            }
        },
        close(){
            document.getElementsByTagName('body')[0].classList.remove("modal-open");
            document.getElementById('addModelo').classList.remove("show");
            document.getElementById('addModelo').style = "";
            document.getElementById('modalBackdrop')?document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop')):'';
        },
        modal(e){
            var body = document.getElementsByTagName('body')[0],ext=false, addModelo = document.getElementById('addModelo'),modalBackdrop = document.getElementById('modalBackdrop');
            body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;})
            if(e.target == addModelo){if(ext){body.classList.remove("modal-open");addModelo.classList.remove("show");addModelo.style = "";}if(modalBackdrop){body.removeChild(modalBackdrop)}}
        }
    },
    mounted(){
        this.div.setAttribute('class','carga');
        this.div.setAttribute('id','modalBackdrop');
    }
}
</script>
