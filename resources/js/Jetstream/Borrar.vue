<template>
    <div @click="modal" class="modal fade" id="borrar" role="dialog" aria-hidden="true">
        <div class="modal-dialog h-full flex items-center mt-0" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red-800 text-white">
                    <h3>Advertencia</h3>
                </div>
                <div class="modal-body">
                    <div class="my-4 text-center">
                        <h5>¡No podrás revertir esto!</h5>
                    </div>
                    <div class="flex justify-center">
                        <jet-button @click="eliminar" class="bg-red-800">
                                ¡Si,borralo!
                        </jet-button>
                        <jet-button @click="close" class="ml-4">
                                Cancelar
                        </jet-button>
                    </div>
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
    props:['link'],
    methods:{
        eliminar(){
            Inertia.post(this.link,{},
            {
                onStart:  () => {
                    document.getElementById('borrar').classList.remove("show");
                    document.getElementById('borrar').style = "";
                },
                onError: errors => {this.$page.props.flash.error = errors;console.log(errors)},
                onFinish: () => {this.close()},
            });
        },
        close(){
            document.getElementsByTagName('body')[0].classList.remove("modal-open");
            document.getElementById('borrar')?document.getElementById('borrar').classList.remove("show"):'';
            document.getElementById('borrar')?document.getElementById('borrar').style = "":'';
            document.getElementById('modalBackdrop')?document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop')):'';
        },
        modal(e){
            var body = document.getElementsByTagName('body')[0],ext=false, borrar = document.getElementById('borrar'),modalBackdrop = document.getElementById('modalBackdrop');
            body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;})
            if(e.target == borrar){if(ext){body.classList.remove("modal-open");borrar.classList.remove("show");borrar.style = "";}if(modalBackdrop){body.removeChild(modalBackdrop)}}
        }
    }
}
</script>
