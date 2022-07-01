<template>
    <envio :modelo="{id:modelo.id}" :sucursales="sucursales" :grupos="grupos" :content="content" :slug="slug"></envio>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-4xl text-center select-none">
                Contenido
            </div>
        </div>
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-xl flex justify-between">
                <div>
                    <jet-nav-link  v-for="(value,id) in modelo.type"   @click.prevent="change(id)" :active="view==id ?true:false" class="mx-2 select-none" :key="id">
                        {{id}}
                    </jet-nav-link>
                    <jet-nav-link v-if="ajustes" @click.prevent="change('Ajustes')" :active="view=='Ajustes' ?true:false" class="mx-2 select-none">
                        Ajustes
                    </jet-nav-link>
                </div>
                <jet-button @click="modal" class="ml-4" data-toggle="modal" data-target="#enviarContenido">
                    Enviar Contenido
                </jet-button>
            </div>
        </div>
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200 row centrate">
            <contenido :view="view" :modelo="modelo" :area="area" />
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import Contenido from '@/Jetstream/Contenido.vue';
    import JetNavLink from '@/Jetstream/NavBtnLink.vue';
    import JetButton from '@/Jetstream/Button.vue';
    import Envio from '@/Jetstream/Envio.vue'

    export default defineComponent({
        components: {
            Contenido,
            JetNavLink,
            JetButton,
            Envio,
            Link
        },
        props:['grupos','sucursales','area','modelo', 'slug'],
        data(){
            return{
                view:Object.keys(this.modelo.type)[0],
                ajustes:true,
                content:[]
            };
        },
        methods:{
            modal(){
                var body = document.getElementsByTagName('body')[0],ext=false, envio = document.getElementById('enviarContenido'),modalBackdrop = document.getElementById('modalBackdrop');
                body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;});
                if(!ext){body.classList.add("modal-open");envio.classList.add("show");envio.style.display = "block";}
                if(!modalBackdrop){var div = document.createElement('div');div.setAttribute('id','modalBackdrop');div.setAttribute('class','modal-backdrop fade show');body.appendChild(div);}
            },
            change(id){
                this.view = id;
            }
        },
        mounted(){
            Object.keys(this.modelo.type).forEach((k,i)=>{
                this.content.push(k);
            })
            
        }
    })
</script>
