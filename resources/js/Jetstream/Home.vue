<template>
    <jet-add-sucursal :rol="rol"></jet-add-sucursal>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-4xl text-center">
                Sucursales
            </div>
        </div>
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200">
            <div class="text-xl flex justify-between">
                <jet-button @click="modal" class="ml-4" data-toggle="modal" data-target="#addSucursal">
                    Agregar Sucursal
                </jet-button>
                <input name="buscarpor" v-model="filtro" class="mr-sm-2 buscador" type="search" placeholder="Buscar por nombre" aria-label="Search">
            </div>
        </div>

        <div class="py-1 sm:px-20 bg-white border-b border-gray-200 row centrate">
            <div class="col-sm" v-for="sucursal in sucfilter" :key="sucursal.id">
                <div class="card text-center" style="width: 14rem; margin-top: 20px">
                    <img style="height: 90px; width: 90px; background-color: #FFFFFF;" :src="sucursal.rutasucu" class="marginIMG rounded mx-auto d-black">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Nombre de la Sucursal:</h6> <h6>{{sucursal.namesucu}}</h6>
                        <h6 class="card-title text-primary">Determinante:</h6> <h6>{{sucursal.det}}</h6>
                        <Link :href="'/sucursal/'+sucursal.slug" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Ver más...</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import JetAddSucursal from '@/Jetstream/AddSucursal.vue';
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            JetAddSucursal,
            JetButton,
            Link
        },
        props:['sucursales','rol'],
        data(){
            return{
                buscar:'',
                sucfilter:[]
            };
        },
        created(){
            this.sucfilter = this.sucursales
        },
        methods:{
            modal(){
                var body = document.getElementsByTagName('body')[0],ext=false, addSucursal = document.getElementById('addSucursal'),modalBackdrop = document.getElementById('modalBackdrop');
                body.classList.forEach(element => {element=='modal-open'?ext=true:ext=false;});
                if(!ext){body.classList.add("modal-open");addSucursal.classList.add("show");addSucursal.style.display = "block";}
            }
        },
        computed:{
            filtro:{
                get(){
                    return this.buscar
                },
                set(value){
                    let info = value.toLowerCase()
                    this.sucfilter = this.sucursales.filter(sucursal=>sucursal.namesucu.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").indexOf(info) != -1);
                    this.sucfilter.length==0?this.sucfilter=this.sucursales.filter(sucursal=>sucursal.det.indexOf(info) != -1):'';
                    this.buscar = value;
                }
            }
        }
    })
</script>

<style>
    .centrate {
        margin: 0;
        justify-content: center;
    }
    .buscador{
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
</style>