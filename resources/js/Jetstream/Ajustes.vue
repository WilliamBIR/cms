<template>
    <div>
        <jet-nav-link  v-for="(id) in eyelash"   @click.prevent="change(id)" :active="view==id ?true:false" class="mx-2 select-none" :key="id">
                {{id}}
        </jet-nav-link>
    </div>
    <div v-if="this.view == 'Información'" class="w-full" id="custom-tabs-one-Informacion" role="tabpanel" aria-labelledby="custom-tabs-one-videos-tab">
        <informacion :slug="slug"></informacion>
    </div>

    <div v-if="this.view == 'Pantalla'" class="w-full" id="custom-tabs-one-pantalla" role="tabpanel" aria-labelledby="custom-tabs-one-imagenes-tab">
        <pantalla :slug="slug"></pantalla>
    </div>

    <div v-if="this.view == 'Red'" class="w-full" id="custom-tabs-one-precios" role="tabpanel" aria-labelledby="custom-tabs-one-precios-tab">
        <red :slug="slug"></red>
    </div>

    <div v-if="this.view == 'Ajustes Hora Fecha'" class="w-full" id="custom-tabs-one-horafecha" role="tabpanel" aria-labelledby="custom-tabs-one-precios-tab">
        <ajustesHoraFecha :slug="slug"></ajustesHoraFecha>
    </div>

    <div v-if="this.view == 'Mosaico'" class="w-full" id="custom-tabs-one-mosaico" role="tabpanel" aria-labelledby="custom-tabs-one-mosaico-tab">
        <mosaico :slug="slug"> </mosaico>
    </div>

    <div v-if="this.view == 'TiempoOnOff'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <tiempoOnOff :slug="slug"></tiempoOnOff>
    </div>

    <div v-if="this.view == 'Update'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <update :slug="slug"></update>
    </div>
    <div v-if="this.view == 'Configuration'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <configuration :slug="slug"></configuration>
    </div>
        
    <div v-if="this.view == 'Device info'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <deviceinfo :slug="slug"></deviceinfo>
    </div>

    <div v-if="this.view == 'Input source'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <inputsource :slug="slug"></inputsource>
    </div>
    <!-- div v-if="this.view == 'Iot'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <iot :slug="slug"></iot>
    </div -->
    <div v-if="this.view == 'Power'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <power :slug="slug"></power>
    </div>
    <div v-if="this.view == 'Security'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <security :slug="slug"></security>
    </div>
    <div v-if="this.view == 'Signage'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <signage :slug="slug"></signage>
    </div>
    <div v-if="this.view == 'Sound'" class="w-full" id="custom-tabs-one-update" role="tabpanel" aria-labelledby="custom-tabs-one-update-tab">
        <sound :slug="slug"></sound>
    </div>
    <!--a :href="'downloadimg/Gaen.jpg'" > Download </a -->
</template> 

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue';
import Informacion from '@/Jetstream/configurationIPK/InformacionIPK.vue';
import JetNavLink from '@/Jetstream/NavBtnLink.vue';
import Pantalla from '@/Jetstream/configurationIPK/PantallaIPK.vue';
import Red from '@/Jetstream/configurationIPK/RedIPK.vue';
import AjustesHoraFecha from '@/Jetstream/configurationIPK/HoraFechaIPK.vue';
import Mosaico from '@/Jetstream/configurationIPK/ModoMosaicoIPK.vue';
import Update from '@/Jetstream/configurationIPK/Update.vue';
import Configuration from '@/Jetstream/configurationIPK/ConfigurationIPK.vue';
import Deviceinfo from '@/Jetstream/configurationIPK/DeviceInfo.vue';
import Inputsource from '@/Jetstream/configurationIPK/InputSource.vue'
import Iot from '@/Jetstream/configurationIPK/Iot.vue'
import Power from '@/Jetstream/configurationIPK/Power.vue'
import Security from '@/Jetstream/configurationIPK/Security.vue'
import Signage from '@/Jetstream/configurationIPK/Signage.vue'
import Sound from '@/Jetstream/configurationIPK/Sound.vue'

export default defineComponent({
    components: {
        Informacion,
        Pantalla,
        Red,
        AjustesHoraFecha,
        Mosaico,
        Update,
        Configuration,
        Deviceinfo,
        Inputsource,
        Iot,
        Power,
        Security,
        Signage,
        Sound,
        vista: 'Información',
        JetButton,
        JetNavLink
    },
    props:['slug'],
    data(){  
        return{
            view: 'Información',
            data: null,
            vista: '',
            eyelash: ['Información', 'Pantalla', 'Red','Ajustes Hora Fecha','Mosaico', 'Update','Configuration',
            'Device info', 'Input source', 'Power','Signage','Sound']
        };
    },
    mounted(){
        // console.log(this);
        // Object.keys(this.ajustes).forEach((k,i)=>{
        //         console.log(k);
        //         // this.content.push(k);
        //     })
    },
    methods:{
        change(id){
            this.view = id;
            this.vista = id;
        }
        
    }
})
</script>
