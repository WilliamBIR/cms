<template>
    <div>
            <h3>Power</h3>
    </div>
    <div>
        <h4 style="text-align:center; font-size:30px"> Power Command </h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Comando</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">

                        <td style="text-align:center">
                        <select v-model="powerCommand">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Power.PowerCommand.REBOOT>Reiniciar </option>
                            <option value="Power.PowerCommand.SHUTDOWN">Apagar </option>
                        </select>
                        </td>        
                        <td style="text-align:center"><a @click.prevent="executePowerCommand" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
                        </td>
                    </tr>
                </tbody>
            </table>           
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Wake On Lan </h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Comando</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center">
                            <select v-model="wakeOnLan">
                                <option disabled value="">Seleccione un elemento</option>
                                <option value=true>Encendido </option>
                                <option value=false>Apagado </option>
                            </select>
                        </td>        
                        <td style="text-align:center"><a @click.prevent="enableWakeOnLan" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
                        </td>
                    </tr>
                </tbody>
            </table>     
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> DPM Signal Type </h4>  

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getDPMWakeup" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="dpmSignalType">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Power.DPMSignalType.CLOCK>Clock </option>
                            <option value=Power.DPMSignalType.CLOCK_WITH_DATA>Clock and Data </option>
                        </select> 
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setDPMWakeup" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Power Management Mode </h4>
        
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getPMMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="pMMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Power.PMMode.PowerOff>powerOff </option>
                            <option value=Power.PMMode.ScreenOff>screenOff </option>
                            <option value=Power.PMMode.ScreenOffAlways>screenOffAlways</option>
                            <option value=Power.PMMode.ScreenOffBacklight>screenOffBacklight </option>
                            <option value=Power.PMMode.SustainAspectRatio>sustainAspectRatio</option>
                            <option value=Power.PMMode.NetworkReady>networkReady </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setPMMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Power on Delay </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getPowerOnDelay" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <input type="number" min=0 max=250 name="Properties" v-model="powerOnDelay">
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setPowerOnDelay" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Power Status </h4>
        
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Display Mode</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">wake on Lan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getPowerStatus" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <input type="text" disabled  v-model="powerStatus.displayMode">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled  v-model="powerStatus.wakeOnLan">
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Display Mode </h4>

    <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Comando</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center">
                        <select v-model="displayMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Power.DisplayMode.DISPLAY_OFF>Screen Off </option>
                            <option value=Power.DisplayMode.DISPLAY_ON>Active </option>
                        </select>
                    </td>
                    <td style="text-align:center">
                        <a @click.prevent="setDisplayMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
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
                powerCommand:"",
                wakeOnLan:false,
                dpmSignalType:"",
                pMMode:null,
                powerOnDelay:null,
                powerStatus:{
                   displayMode:"",
                   wakeOnLan:false,
                   allOnTimer:false,
                   allOffTimer:false, 
                },
                displayMode:"",

            }
        },
        beforeMount(){
            console.log('montando Power')        },
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
                    if(payload.request.function == "getDPMWakeup"){ 
                        if(payload.message.dpmSignalType=="clock"){
                            this.dpmSignalType="Power.DPMSignalType.CLOCK"
                        }
                        if(payload.message.dpmSignalType=="clockAndData"){
                            this.dpmSignalType="Power.DPMSignalType.CLOCK_WITH_DATA"
                        }
                        console.log(this.dpmSignalType)};  
                    if(payload.request.function == "getPMMode"){ 
                        if(payload.message.mode=="powerOff"){
                            this.pMMode="Power.PMMode.PowerOff"
                        }
                        if(payload.message.mode=="screenOff"){
                            this.pMMode="Power.PMMode.ScreenOff"
                        }
                        if(payload.message.mode=="screenOffAlways"){
                            this.pMMode="Power.PMMode.ScreenOffAlways"
                        }
                        if(payload.message.mode=="screenOffBacklight"){
                            this.pMMode="Power.PMMode.ScreenOffBacklight"
                        }
                        if(payload.message.mode=="sustainAspectRatio"){
                            this.pMMode="Power.PMMode.SustainAspectRatio"
                        }
                        if(payload.message.mode=="networkReady"){
                            this.pMMode="Power.PMMode.NetworkReady"
                        }
                        console.log(this.pMMode)
                    }  
                    if(payload.request.function == "getPowerOnDelay"){ this.powerOnDelay=payload.message.delayTime;console.log(this.powerOnDelay)};  
                    if(payload.request.function == "getPowerStatus"){ this.powerStatus=payload.message;console.log(this.powerStatus)};  
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            executePowerCommand(){
                var comando=`{
                    "func":"executePowerCommand",
                    "options":{
                        powerCommand:${this.powerCommand}
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            enableWakeOnLan(){
                var comando=`{
                    "func":"enableWakeOnLan",
                    "options":{
                        wakeOnLan:${this.wakeOnLan}
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})  
            },
            getDPMWakeup(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getDPMWakeup" }`})
            },
            getPMMode(){
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message:`{"func" : "getPMMode"}`})
            },
            getPowerOnDelay(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getPowerOnDelay" }`})
            },
            getPowerStatus(){
                 this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getPowerStatus" }`})
            },
            setDisplayMode(){
                var comando=`{
                    "func":"setDisplayMode",
                    "options":{
                        displayMode:${this.displayMode}
                    }
                }`
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setDPMWakeup(){
                var comando=`{
                    "func":"setDPMWakeup",
                    "options":{
                        dpmSignalType:${this.dpmSignalType}
                    }
                }`
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setPMMode(){
                var comando=`{
                    "func":"setPMMode",
                    "options":{
                        mode:${this.pMMode}
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setPowerOnDelay(){
                var comando=`{
                    "func":"setPowerOnDelay",
                    "options":{
                        delayTime:${this.powerOnDelay}
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            }                       
        }
    })
</script>
