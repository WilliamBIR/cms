<template>
    <div class="grid place-items-center">
        <h4 style="text-align:center; font-size:30px"> Fecha y hora del dispositivo</h4>
    </div> 
    <div>
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody v-if="timerListOn" id="list" class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><p class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">{{fecha.day}}/{{fecha.month}}/{{fecha.year}}</p> </td>
                    <td class="px-2 py-2 whitespace-nowrap"><p class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">{{hora.hour}}:{{hora.minute}}:{{hora.sec}}</p> </td>
                    
                    <td style="text-align:center">
                        <a @click="consultartiempo" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:24px">Modificar hora actual </h4>
        <div>
            <p>
            <select v-model="this.superntp" >
                <option selected disabled>Selecciona una opcion</option>
                <option value=true>ntp activo</option>
                <option value=false>ntp desactivado</option>
            </select>
            <a @click.prevent="setNtp" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>
            </p>        
        </div>
        
        <div v-if="this.ntp.ntp==true">
            <h4 style="text-align:center; font-size:30px">Zona horaria Actual</h4>
            <p v-show="false">gettimeZoneList
            <a @click.prevent="getTimeZoneList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">gettimeZoneListy</a>         
            </p>

            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Consultar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Continente</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">País</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ciudad</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                    </tr>
                </thead>
                <tbody  class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td><a @click.prevent="getTimeZone" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener Zona Horaria</a></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input  v-model="timeZone.continent"  type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input  v-model="timeZone.country" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input  v-model="timeZone.city" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                        
                        <td style="text-align:center">
                            <a @click="setTimeZone" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar Zona Horaria</a>
                        </td>
                        
                    </tr>
                </tbody>
            </table>

        
        
        </div>


        <div v-if="this.ntp.ntp==false">
            <p> Para modificar la hora actual es necesario que no este activo el tiempo en modo automatico, es decir, por zona de tiempo
                si esta activo, no es posible cambiar la hora con este comando</p> 
            <input type="datetime-local" name="start_time" v-model="moditiempo">
            <a @click.prevent="modificartiempo" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">modificar</a>         
        </div>
    </div>


    <div class="grid place-items-center"><h4 style="text-align:center; font-size:30px"> Horarios de encendido y apagado del dispositivo</h4>
        <button type="button"  @click.prevent="getOnOffTimers" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
            Recargar
        </button>             
    </div> 
    
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <h4 style="text-align:center; font-size:24px"> Encendido </h4>
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
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.week" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    
                    <td>
                        <a @click="cancelOnOffTimer(n.id)" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">X</a>
                    </td>
                 
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">        
        <h4 style="text-align:center; font-size:24px"> Apagado </h4>
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
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.hour" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.minute" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td disabled class="px-2 py-2 whitespace-nowrap"><input disabled :id="'normal-precio-'+idx" v-model="n.week" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                                      
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
        <h4 style="text-align:center; font-size:24px"> Agregar evento </h4>
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

</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent({
        components:{
        },
        props:["slug"],
        data(){
            return{
                fecha:{
                    year:2022,
                    month:21,
                    day:1,
                },
                hora:{
                    hour:"00",
                    minute:"00",
                    sec:"00",
                },
                ntp:{
                    ntp:null,
                    ntpServerAddress:""
                },
                moditiempo:null,
                timezone:null,
                horaint:null,
                aux1:null,
                timerListOn: [],
                timerListOff:[],
                timerlist:{
                    hour:0,
                    minute:0,
                    type:"",
                },
                checkedDays:[],
                timerOnLength:0,
                timerOffLength:0,
                timeZone:{
                    continent:null,
                    country:null,
                    city:null
                },
                superntp:false,
                timeZoneList:[],
            }
        },
        beforeMount(){
            console.log('consultando tiempo actual')
            this.consultartiempo()
            setTimeout(()=>{this.getOnOffTimers()},2000);
            
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
                    //this.zona = payload.request.function == "getTimeZone"? payload.message.timeZone.continent: this.timezone;
                    if(payload.request.function == "getCurrentTime"){
                        this.fecha.year=payload.message.year;
                        this.fecha.month=payload.message.month;
                        this.fecha.day=payload.message.day;
                        this.hora.hour=this.revisionceros(payload.message.hour.toString());
                        this.hora.minute=this.revisionceros(payload.message.minute.toString());
                        this.hora.sec=this.revisionceros(payload.message.sec.toString());
                        this.ntp.ntp=payload.message.ntp
                        this.ntp.ntpServerAddress=payload.message.ntpServerAddress
                        console.log(this.fecha)
                        console.log(this.hora)
                        console.log(this.ntp)
                    }
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
                    if(payload.request.function == "getTimeZone"){ 
                        this.timeZone=payload.message.timeZone
                        console.log(this.timeZone)
                    }
                    if(payload.request.function == "getTimeZoneList"){ this.timeZoneList=payload.message.timeZone;console.log(this.timeZoneList)};
                    
                }  
            }.bind((this)));
        },
        methods:{
            setNtp(){
                console.log('seteando ntp')
                                var comando=`{
                    "func": "setCurrentTime",
                    "options": {
                    year:${this.fecha.year},
                    month:${this.fecha.month},
                    day:${this.fecha.day},
                    hour:${this.hora.hour},
                    minute:${this.hora.minute},
                    sec:${this.hora.sec},
                    ntp:${this.superntp}
                    }
                }`;
                console.log(comando)   
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: comando});          
                setTimeout(()=>{this.consultartiempo()},1500);
            },
            getTimeZone(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getTimeZone" }`});
            },
            getTimeZoneList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug,message:`{ "func":"getTimeZoneList"}`})
            },
                        //La lista de timeZone se encuentra en la getListZoneCity
            setTimeZone(){
                var comando=`{
                    "func":"setTimeZone",
                    "options":{
                        timeZone:{
                            continent:"${this.timeZone.continent}",
                            country:"${this.timeZone.country}",
                            city:"${this.timeZone.city}",
                        }
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getTimeZone()},1500);
                setTimeout(()=>{this.consultartiempo()},1500);
                
            },
            revisionceros(arevisar){
                if(arevisar.length<2){
                    arevisar='0'+arevisar
                }
                return arevisar
            },
            consultartiempo(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getCurrentTime" }`});
            },
            consultarzona(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getTimeZone" }`});
            },
           
            modificartiempo(){
                console.log('modificando tiempo')
                var comando=`{
                    "func": "setCurrentTime",
                    "options": {
                    year:${this.moditiempo.substring(0,4)},
                    month:${this.moditiempo.substring(5,7)},
                    day:${this.moditiempo.substring(8,10)},
                    hour:${this.moditiempo.substring(11,13)},
                    minute:${this.moditiempo.substring(14,16)},
                    sec:00,
                    }
                }`;
                console.log(comando)   
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: comando});          
                setTimeout(()=>{this.consultartiempo()},500);
            },
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
                setTimeout(()=>{this.getOnOffTimers()},1500);
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
