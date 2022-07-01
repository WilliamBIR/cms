<template>
    <div >
    <table class="table-fixed">
            <thead> <p>Información Mosaico</p>
            <tr>
                <th>Caracteristica</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
                <tr> <td>Mosaico activo</td><td>{{ tile.enabled }}</td></tr>
                <tr> <td>Total filas</td><td>{{ tile.row }}</td></tr>
                <tr> <td>Total columnas</td><td>{{ tile.column }}</td></tr>
                <tr> <td>Id del Mosaico</td><td>{{ tile.tileId }}</td></tr>
                <tr> <td>Modo natural</td><td>{{ tile.naturalMode}}</td></tr>
            </tbody> 
    </table>
    </div>
    <div>
        <h3>Cambiar Valores del Mosaico</h3>
            <div>
                <p v-if="!tile.enabled">El modo mosaico esta desactivado</p>
                <select v-model="activar1">
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="true">Encender </option>
                    <option value="false">Apagar </option>
                </select>
                <a @click.prevent="onoff" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar modo</a>         
            </div>
            <div v-if="tile.enabled">
                <p>Introduzca numero de filas</p>
                <input type="number" v-model="row" placeholder="num de columnas">
                <p>Introduzca numero de columnas</p>
                <input type="number" v-model="column" placeholder="num de filas">
                <p>Introduzca el numero Id del mosaico </p>
                <input type="number" v-model="tileId" placeholder="Id del mosaico">
                <p> Modo Natural encendido</p>
                <select v-model="naturalMode">
                    <option disabled value="">Seleccione un elemento</option>
                    <option value="true">Encender </option>
                    <option value="false">Apagar </option>
                </select>
                <a @click.prevent="actualizar" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a>         
            </div>
                
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import  Videos from '@/Jetstream/Videos.vue';
    import  Precios from '@/Jetstream/Precios.vue';
    import  PreciosNormales from '@/Jetstream/PreciosNormales.vue';
    import  Imagenes from '@/Jetstream/Imagenes.vue';
    import Ajustes from '@/Jetstream/Ajustes.vue';

    export default defineComponent({
        components:{
            // Videos,
            // Ajustes,
            // Precios,
            // PreciosNormales,
            // Imagenes,
        },
        props:['view','area','modelo', 'dataIPK',"slug"],
        data(){
            return{
                tile:{
                    enabled:false,
                    row:1,
                    column:1,
                    tileId:1,
                    naturalMode:true
                },
                activar1:false,
                row:1,
                column:1,
                tileId:1,
                naturalMode:true
            }
        },
        beforeMount(){
            console.log('consultando tile')
            this.getTileInfo()
        },
        mounted(){
            let dropdown = document.querySelectorAll(".dropdown-toggle");
                dropdown.forEach((el) => {
                    el.addEventListener("click", () => {
                        el.parentNode.classList.toggle("open");
                    });
            });
            this.$inertia.socket.on("successIPK", function (payload) {
                console.log(payload);
                if (payload.error) {
                    console.log(`Error en slugIPK: ${payload.uid}, error: ${JSON.stringify(payload.error.errorText)}`);
                } else {
                    console.log(`Exito en slugIPK: ${payload.uid}`);
                    this.tile = payload.request.function == "getTileInfo"? payload.message: this.tile;
                    //console.log(this.tile)
                }  
            }.bind((this)));
        },
        methods:{
            getTileInfo(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getTileInfo" }`});
            },
            onoff(){
                console.log(this.activar1)
                var comando=`{
                    "func": "setTileInfo",
                    "options": {
                        tileInfo:{
                           enabled:${this.activar1},
                            row:2,
                           column:2,
                           tileId:1,
                           naturalMode:true,
                        }
                    }
                }`;
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: comando});
                setTimeout(()=>{this.getTileInfo()},500);
            },
            actualizar(){
                console.log(this.row)
                console.log(this.column)
                console.log(this.tileId)
                console.log(this.naturalMode)
                var comando=`{
                    "func": "setTileInfo",
                    "options": {
                        tileInfo:{
                           enabled:true,
                           row:${this.row},
                           column:${this.column},
                           tileId:${this.tileId},
                           naturalMode:${this.naturalMode},
                        }
                    }
                }`;
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: comando});
                setTimeout(()=>{this.getTileInfo()},500);
            },
           
        }
    })
</script>
