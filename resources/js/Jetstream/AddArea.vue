<template>
    <div @click="modal" class="modal fade bg-gray-600/25" id="addArea" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Area</h5>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" class="form-group">
                        <div class="form-group">
                            <label>Nombre</label>
                            <select class="form-control" v-model="form.name" name="name" required>
                                <option  v-for="area in areas" :key="area.id" :value="area.name">{{area.name}}</option>
                            </select>
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
    props:['sucursal','areas'],
    data(){
        return{
            form:{
                name:"",
                det:this.sucursal.det,
                id:this.sucursal.id
            },
            submitBolean: true,
            div : document.createElement('div')
        };
    },
    methods:{
        submit(){
            if(this.submitBolean){
                Inertia.post('/sucursal/create',
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
            document.getElementById('addArea').classList.remove("show");
            document.getElementById('addArea').style = "";
            document.getElementById('modalBackdrop')?document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop')):'';
        },
        modal(e){
            var body = document.getElementsByTagName('body')[0],ext=false, addArea = document.getElementById('addArea'),modalBackdrop = document.getElementById('modalBackdrop');
            body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;})
            if(e.target == addArea){if(ext){body.classList.remove("modal-open");addArea.classList.remove("show");addArea.style = "";}if(modalBackdrop){body.removeChild(modalBackdrop)}}
        }
    },
    mounted(){
        this.div.setAttribute('class','carga');
        this.div.setAttribute('id','modalBackdrop');
    }
}
</script>
