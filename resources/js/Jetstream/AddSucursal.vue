<template>
    <div @click="modal" class="modal fade bg-gray-600/25" id="addSucursal" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="rol<4 && rol>1">Agregar nueva Sucursal de Walmart</h5>
                    <h5 v-else-if="rol>3">Agregar nueva Sucursal de la Europea</h5>
                    <h5 v-else>Agregar nueva Sucursal</h5>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" class="form-group" style="margin-top: 25px">
                        <div class="form-group">
                            <label>Nombre de Sucursal:</label>
                            <input class="form-control" v-model="form.namesucu" type="text" name="namesucu" required>
                        </div>
                        <div v-if="rol<4" class="form-group">
                            <label>Determinante:</label>
                            <input class="form-control" v-model="form.det" type="text" name="det" required>
                        </div>
                        <input v-else type="hidden" name="det" value="0" />
                        <div v-if="rol<2" class="form-group">
                            <label>Tienda:</label>
                            <select class="form-control" v-model="form.store" name="store" required>
                                <option selected disabled>Seleccione una opcion</option>
                                <option value="walmart">Walmart</option>
                                <option value="europea">La Europea</option>
                                <option value="express">Walmart Express</option>
                            </select>
                        </div>
                        <div v-else class="form-group">
                            <input type="hidden" name="store" :value="rol<4?'walmart':'europea'" />
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
    props:['rol'],
    data(){
        return{
            form:{
                namesucu:"",
                det:"",
                store:""
                
            },
            submitBolean: true,
            div : document.createElement('div')
        };
    },
    methods:{
        submit(){
            if(this.submitBolean){
                console.log('hola');
                Inertia.post('/home/create',
                {
                    namesucu: this.form.namesucu,
                    det: this.form.det,
                    store: this.form.store
                },{
                    onStart:()=>{this.submitBolean = false},
                    onError: errors => {this.$page.props.flash.error = errors;console.log(errors)},
                    onFinish: () => {this.close();this.submitBolean = true},
                });
                document.getElementsByTagName('body')[0].appendChild(this.div);
            }
        },
        close(){
            document.getElementsByTagName('body')[0].classList.remove("modal-open");
            document.getElementById('addSucursal').classList.remove("show");
            document.getElementById('addSucursal').style = "";
            document.getElementById('modalBackdrop')?document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop')):'';
        },
        modal(e){
            var body = document.getElementsByTagName('body')[0],ext=false, addSucursal = document.getElementById('addSucursal'),modalBackdrop = document.getElementById('modalBackdrop');
            body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;})
            if(e.target == addSucursal){if(ext){body.classList.remove("modal-open");addSucursal.classList.remove("show");addSucursal.style = "";}if(modalBackdrop){body.removeChild(modalBackdrop)}}
        }
    },
    mounted(){
        this.div.setAttribute('class','carga');
        this.div.setAttribute('id','modalBackdrop');
    }
}
</script>
