<template>
    <div class="grid place-items-center"><p class="font-bold">Horarios de encendido y apagado del dispositivo</p>
    </div> 
    
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <h4 style="text-align:center; font-size:30px"> Encendido </h4>
    </div>
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Minuto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Día</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody v-if="timerListOn" id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in timerListOn"  :key="idx" :id="'tr'+idx" class="drag" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" value="Encendido"  type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.hour" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.minute" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.week" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    
                    <td>
                        <a @click="cancelOnOffTimer(n.id)" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">X</a>
                    </td>
                 
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">        
        <h4 style="text-align:center; font-size:30px"> Apagado </h4>
    </div>
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Minuto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Día</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody v-if="timerListOff" id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in timerListOff" :key="idx" :id="'tr'+idx" class="drag" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" value="Apagado" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.hour" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.minute" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.week" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                                      
                    <td>
                        <a @click="cancelOnOffTimer(n.id)" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">X</a>
                    </td>

               
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w-full flex justify-center my-4">
        <a @click="clearAll" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Eliminar todo</a>
    </div>
    <!-- <div v-if="button" class="w-full flex justify-center my-4"> -->
    <!-- Aqui se agrega la tabla que va a agregar componentes, solo se puede agregar de 1 en 1 o hay problemas -->
    <div>
        <h4 style="text-align:center; font-size:30px"> Agregar evento </h4>
    </div>
    <div>
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Minuto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Día</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody v-if="timerListOn" id="list" class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td class="px-2 py-2 whitespace-nowrap">
                        <select v-model="timerlist.type" :id="'type-powe'+idx" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">
                            <option selected disabled>Selecciona una opcion</option>
                            <option v-if="timerOffLength<7" value="OFFTIMER">Apagar</option>
                            <option v-if="timerOnLength<7" value="ONTIMER">Prender</option>
                        </select>
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="timerlist.hour" type="number" min=0 max=23 class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="timerlist.minute" type="number" min=0 max=59 class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <input type="checkbox" id="Lunes" value="Lunes" v-model="checkedDays">
                    <label for="Lunes">Lunes</label><br>
                    <input type="checkbox" id="Martes" value="Martes" v-model="checkedDays">
                    <label for="Martes">Martes</label><br>
                    <input type="checkbox" id="Miercoles" value="Miercoles" v-model="checkedDays">
                    <label for="Miercoles">Miercoles</label><br>
                    <input type="checkbox" id="Jueves" value="Jueves" v-model="checkedDays">
                    <label for="Jueves">Jueves</label><br>
                    <input type="checkbox" id="Viernes" value="Viernes" v-model="checkedDays">
                    <label for="Viernes">Viernes</label><br>
                    <input type="checkbox" id="Sabado" value="Sabado" v-model="checkedDays">
                    <label for="Sabado">Sabado</label><br>
                    <input type="checkbox" id="Domingo" value="Domingo" v-model="checkedDays">
                    <label for="Domingo">Domingo</label><br>
                    <input type="checkbox" id="Diario" value="Diario" v-model="checkedDays">
                    <label for="Diario">Diario</label><br>
                                        
                    <td style="text-align:center">
                        <a @click="reserveOnOffTimer" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">✓</a>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>

    <!--Aqui termina la tabla que agrega -->
    
</template>

<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        components:{
            
        },
        props:['view', 'slug'],
        data(){
            return{
                timerListOn: [],
                timerListOff:[],
                timerlist:{
                    hour:0,
                    minute:0,
                    type:"",
                },
                checkedDays:[],
                timerOnLength:0,
                timerOffLength:0
                }
        },
        beforeMount(){
            this.getOnOffTimers();
        },
        mounted(){
            this.$inertia.socket.on("successIPK", function (payload) {
                console.log(payload);
                if (payload.error) {
                    console.log(`Error en slugIPK: ${payload.uid}, error: ${JSON.stringify(payload.error.errorText)}`);
                } else {
                    console.log(`Exito en slugIPK: ${payload.uid}`);
                    if(payload.request.function == "getAllOnOffTimers" && payload.message){
                        this.timerListOn=[]
                        this.timerListOff=[]
                        for(var i=0;i<payload.message.timerList.length;i++){
                            payload.message.timerList[i].week=this.dec2str(payload.message.timerList[i].week)
                            if(payload.message.timerList[i].type=="ONTIMER"){
                                
                                this.timerListOn.push(payload.message.timerList[i])
                            }
                            if(payload.message.timerList[i].type=="OFFTIMER"){
                                this.timerListOff.push(payload.message.timerList[i])
                            }
                        }
                        this.timerOnLength=this.timerListOn.length
                        this.timerOffLength=this.timerListOff.length
                        console.log(this.timerOnLength)
                        console.log(this.timerOffLength)
                        console.log(this.timerListOn);
                        console.log(this.timerListOff)
                    }
                }  
            }.bind((this)));
        },
        
        methods:{
            getOnOffTimers(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getAllOnOffTimers" }`})},
            clearTimers(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "clearAllOnOffTimers" }`})},
            reserveOnOffTimer() {
                var conversion=this.semanal(this.checkedDays)
                const comando = `{
                    "func": "reserveOnOffTimer",
                    "options": {
                        type : Time.TimerType.${this.timerlist.type},
                        hour : ${this.timerlist.hour},
                        minute : ${this.timerlist.minute},
                        week : ${conversion}
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getOnOffTimers()},1000);
                this.reinicioTimer();
            },
            semanal(datos){
                var suma= 0;
                console.log(datos)
                if(datos.includes('Diario')){
                    console.log('Diario')
                    suma=127
                }
                else{
                    if(datos.includes('Lunes')){suma+=1}
                    if(datos.includes('Martes')){suma+=2}
                    if(datos.includes('Miercoles')){suma+=4}
                    if(datos.includes('Jueves')){suma+=8}
                    if(datos.includes('Viernes')){suma+=16}
                    if(datos.includes('Sabado')){suma+=32}
                    if(datos.includes('Domingo')){suma+=64}
                    
                }
                console.log(suma)
                return suma
            },
            submit(){
                console.log(this.timerList);
                
            },
            dec2str(dec){
                var aux=dec.toString(2)
                while(aux.length<7){
                    aux="0"+aux
                }
                var dias=""
                if(aux=='1111111'){dias+="Diario"}
                else{
                    if(aux.charAt(6)=='1'){dias+="-Lunes-"}
                    if(aux.charAt(5)=='1'){dias+="-Martes-"}
                    if(aux.charAt(4)=='1'){dias+="-Miercoles-"}
                    if(aux.charAt(3)=='1'){dias+="-Jueves-"}
                    if(aux.charAt(2)=='1'){dias+="-Viernes-"}
                    if(aux.charAt(1)=='1'){dias+="-Sabado-"}
                    if(aux.charAt(0)=='1'){dias+="-Domingo-"}
                    
                }
                return dias
            },
            reinicioTimer(){
                this.timerlist.hour=0
                this.imerlist.minute=0
                this.timerlist.type=""
            },

            clearAll(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "clearAllOnOffTimers" }`});
                this.getOnOffTimers();
            },
            cancelOnOffTimer(id){
                var comando=`{
                    "func": "cancelOnOffTimer",
                    "options":{
                        id:${id}
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getOnOffTimers()},500);
            }
            
        }
    })
</script>
