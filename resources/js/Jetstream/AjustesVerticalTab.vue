<template>
    <div v-if="view == 'Videos' && modelo.type.Videos" class="w-full" id="custom-tabs-one-videos" role="tabpanel" aria-labelledby="custom-tabs-one-videos-tab">
        <videos :data="{'area':area.name,'modelo':modelo.name,'det':modelo.det, 'number':modelo.type.Videos.Multi}" :videos="modelo.type.Videos" :show="area.name =='Video Wall'?(modelo.name!='Probadores'?true:false):area.name == 'Meses sin Intereses'?(modelo.name.indexOf('-')==-1?true:false):false"/>
    </div>

    <div v-if="view == 'Imagenes' && modelo.type.Imagenes" class="w-full" id="custom-tabs-one-imagenes" role="tabpanel" aria-labelledby="custom-tabs-one-imagenes-tab">
        <imagenes :data="{'area':area.name,'modelo':modelo.name,'det':modelo.det, 'number':modelo.type.Imagenes.Multi}" :imagenes="modelo.type.Imagenes" />
    </div>

    <div v-if="view == 'Precios' && modelo.type.Precios" class="w-full" id="custom-tabs-one-precios" role="tabpanel" aria-labelledby="custom-tabs-one-precios-tab">
        <precios v-if="modelo.type.Precios.Especial || modelo.type.Precios.Extra" :area="area.name" :modelo="modelo.name" :det="modelo.det" :precios="modelo.type.Precios" :especial2="modelo.especial"></precios>
        <precios-normales v-else :normal="modelo.type.Precios.Normales" :button="true" :area="area.name" :modelo="modelo.name" :det="modelo.det" />
    </div>

    <div v-if="view == 'Ajustes' && modelo.type.Precios" class="w-full" id="custom-tabs-one-precios" role="tabpanel" aria-labelledby="custom-tabs-one-precios-tab">
        <ajustes :slug="modelo.slug" :dataIPK="dataIPK"></ajustes>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue';

// import informacionPantalla

export default defineComponent({
    components: {
        JetButton
    },
    props:['slug'],
    data(){
        return{
            rotacion: null,
        };
    },
    mounted(){
        let dropdown = document.querySelectorAll('.dropdown-toggle');
        dropdown.forEach(el => {
            el.addEventListener('click',()=>{
                el.parentNode.classList.toggle('open');
            });
        });
    },
    methods:{
        // METODOS
    }
})
</script>
