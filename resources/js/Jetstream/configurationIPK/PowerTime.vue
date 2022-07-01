<template>
    <div class="grid place-items-center"><p class="font-bold">Horarios de encendido y apagado del dispositivo</p>
        <button>Reiniciar</button>
    </div>
    <hr>
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <!-- <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">id</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Minuto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Día</th> -->
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">id</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Minuto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Día</th>
                </tr>
            </thead>
            <tbody v-if="timerList" id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in timerList" :key="idx" :id="'tr'+idx" class="drag" draggable="true" :ondragstart="DragStart" :ondragenter="DragEnter" :ondragend="DragEnd" :ondragleave="DragLeave" role="row">
                    <td class="px-2 py-2 whitespace-nowrap">
                        <p class="px-3 py-3 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none text-center">{{idx}}
                        </p>
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap">
                        <select v-model="n.type" :id="'type-powe'+idx" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">
                            <option selected disabled>Selecciona una opcion</option>
                            <option value="OFFTIMER">Apagar</option>
                            <option value="ONTIMER">Prender</option>
                        </select>
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.hour" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.minute" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap">
                        <select v-model="n.week" :id="'normal-centavo-'+idx" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">
                            <option selected disabled>Selecciona una opcion</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="4">Miecoles</option>
                            <option value="8">Jueves</option>
                            <option value="16">Viernes</option>
                            <option value="32">Sabado</option>
                            <option value="64">Domingo</option>
                            <option value="127">Semana</option>
                        </select>
                    </td>
                    <input :name="'id-'+idx" type="hidden" :value="n.id">
                </tr>
            </tbody>
        </table>
    </div>
    <!-- <div v-if="button" class="w-full flex justify-center my-4"> -->
    <div class="w-full flex justify-center my-4">
        <a @click="clearAll" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Eliminar todo</a>
        <a @click="borrar" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">-</a>
        <form @submit.prevent="submit">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                Configurar
            </button>
        </form>
        <a @click="agregar" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">+</a>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        components:{
            
        },
        props:['view', 'slug'],
        data(){
            return{
                timerList: null,
                div : document.createElement('div'),
                centavo:true,
                deli:false,
                dragged:{
                    elem:null,
                    elem2:null
                },
                valor: null,
                arrayNormal: {
                    area: this.area,
                    modelo: this.modelo,
                    det: this.det,
                    precios: {}               
                },
            }
        },
        beforeMount(){
            this.getOnOffTimers();
            // setTimeout(()=>{this.reserveTimer();},500);
        },
        mounted(){
            this.$inertia.socket.on("successIPK", function (payload) {
                console.log(payload);
                if (payload.error) {
                    console.log(`Error en slugIPK: ${payload.uid}, error: ${JSON.stringify(payload.error.errorText)}`);
                } else {
                    console.log(`Exito en slugIPK: ${payload.uid}`);
                    if(payload.request.function == "getAllOnOffTimers" && payload.message){this.timerList = payload.message.timerList}
                    console.log(this.timerList);
                    // else if(payload.request.function == "getSystemUsageInfo"){this.infoHardware = payload.message}
                }  
            }.bind((this)));
        },
        
        methods:{
            getOnOffTimers(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getAllOnOffTimers" }`})},
            clearTimers(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "clearAllOnOffTimers" }`})},
            reserveTimer() {
                const options = `{
                    "func": "reserveOnOffTimer",
                    "options": {
                        type : Time.TimerType.OFFTIMER,
                        hour : 9,
                        minute : 0,
                        week : Time.TimerWeek.MONDAY + Time.TimerWeek.MONDAY
                    }
                }`;
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: options});
            },
            submit(){
                console.log(this.timerList);
                
            },
            agregar(){
                if(this.timerList.length >= 7){return}
                if(Array.isArray(this.timerList))
                    this.timerList.push({"type":"","hour": 0,"minute":0, "week":0});
                else
                    this.timerList[Object.values(this.timerList).length] = {'id':'','type':'','hour': 0,'minute':0,'weeks':0};
            },
            borrar(){
                if(Array.isArray(this.normal))
                    this.timerList.length>1?this.timerList.splice(this.timerList.length-1,1):'';
                else
                    Object.values(this.timerList).length>1?(delete this.timerList[Object.values(this.timerList).length-1]):'';
            },
            clearAll(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "clearAllOnOffTimers" }`});
                this.getOnOffTimers();
            },
            DragStart(evt){
                evt.dataTransfer.setData('text/plain',null);
                this.dragged.elem = evt.target;
            },
            DragEnter(evt){
                if(evt.target.parentNode != this.dragged.elem && evt.target.localName == 'p'){
                    this.dragged.elem2 = evt.target.parentNode.parentNode;
                    this.dragged.elem2.classList.add('bg-blue-200');
                }
            },
            DragLeave(evt){
                if(evt.target.parentNode.parentNode == this.dragged.elem2 && evt.target.localName == 'p'){
                    this.dragged.elem2.classList.remove('bg-blue-200');
                }
            },
            // DragEnd(evt){
            //     if(this.dragged.elem != this.dragged.elem2){
            //         let id = this.dragged.elem.id.split('r')[1];
            //         let id2 = this.dragged.elem2.id.split('r')[1];
            //         this.dragged.elem2.children[1].children[0].value = this.normal[id].name;
            //         this.dragged.elem2.children[2].children[0].value = this.normal[id].precio;
            //         this.dragged.elem2.children[3].children[0].value = this.normal[id].centavo;
            //         this.dragged.elem.children[1].children[0].value = this.normal[id2].name;
            //         this.dragged.elem.children[2].children[0].value = this.normal[id2].precio;
            //         this.dragged.elem.children[3].children[0].value = this.normal[id2].centavo;
            //         let pos = {name:this.normal[id].name,precio:this.normal[id].precio,centavo:this.normal[id].centavo};
            //         this.normal[id].name = this.normal[id2].name;
            //         this.normal[id].precio = this.normal[id2].precio;
            //         this.normal[id].centavo = this.normal[id2].centavo;
            //         this.normal[id2].name = pos.name;
            //         this.normal[id2].precio = pos.precio;
            //         this.normal[id2].centavo = pos.centavo;
            //     }
            // }
        }
    })
</script>
