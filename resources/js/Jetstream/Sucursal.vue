<template>
    <jet-add-area :sucursal="sucursal" :areas="tareas"></jet-add-area>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-4xl text-center">
                Areas
            </div>
        </div>
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-xl flex justify-between">
                <jet-button @click="modal" class="ml-4" data-toggle="modal" data-target="#addArea">
                    Agregar Area
                </jet-button>
            </div>
        </div>
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200 row centrate">
            <div class="col-sm" v-for="area in areas" :key="area.id">
                <div class="card text-center my-3" style="width: 14rem;">
                    <img style="height: 90px; width: 90px; background-color: #FFFFFF;" :src="area.rutaarea" class="marginIMG rounded mx-auto d-black">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Nombre de la Area:</h6> <h6>{{area.name}}</h6>
                        <h6 class="card-title text-primary">Determinante:</h6> <h6>{{area.det}}</h6>
                        <Link :href="'/area/'+area.slug" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Ver más...</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import JetAddArea from '@/Jetstream/AddArea.vue';
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            JetAddArea,
            JetButton,
            Link
        },
        props:['sucursal','areas','rol','tareas'],
        methods:{
            modal(){
                var body = document.getElementsByTagName('body')[0],ext=false, addArea = document.getElementById('addArea'),modalBackdrop = document.getElementById('modalBackdrop');
                body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;});
                if(!ext){body.classList.add("modal-open");addArea.classList.add("show");addArea.style.display = "block";}
            }
        }
    })
</script>
