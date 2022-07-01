<template>
    <div>
            <h3>Sound</h3>
    </div>
   <div >
        <h4 style="text-align:center; font-size:30px"> Sound Mode</h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getSoundMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="soundMode.mode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Standard>Standard </option>
                            <option value=Cinema>Cinema </option>
                            <option value=ClearVoice>ClearVoice </option>
                            <option value=Sports>Sports  </option>
                            <option value=Music>Music </option>
                            <option value=Game>Game  </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <input type="range" min=-50 max=50 v-model="soundMode.balance" class="slider" id="rangeBalance"  />
                        <div class="flex justify-between">
                            <div class="w-3/4 slider-label">Balance
                            </div>
                            <div class="w-1/4 slider-value">
                                <span id="valBalance">{{ soundMode.balance }}</span>
                            </div>
                </div>
                    </td>
                    <td style="text-align:center">
                        <a @click.prevent="setSoundMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>   
        <h4 style="text-align:center; font-size:30px"> Sound Out</h4>
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
                    <td style="text-align:center"><a @click.prevent="getSoundOut" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="soundOut.speakerType">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=SignageSpeaker>tv_speaker </option>
                            <option value=LGSoundSync>bt_soundbar </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setSoundOut" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>   
        <h4 style="text-align:center; font-size:30px"> Sound Status</h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">externalSpeaker</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">muted</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Volumen</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">volOsdEnabled</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getSoundStatus" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                         <select v-model="soundStatus.externalSpeaker">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>External </option>
                            <option value=false>No </option>
                        </select>
                        <a @click.prevent="setExternalSpeaker" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Ejecutar</a>                 
        
                    </td> 
                    <td style="text-align:center">
                        <select v-model="soundStatus.muted">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>muted </option>
                            <option value=false>false </option>
                        </select>
                        <a @click.prevent="setMuted" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Ejecutar</a>                 
                    </td>
                    <td style="text-align:center">
                        <input type="range" min=0 max=100 v-model="soundStatus.level" class="slider" id="rangeBalance"  />
                            <div class="flex justify-between">
                                <div class="w-3/4 slider-label">Volumen</div>
                                <div class="w-1/4 slider-value">
                                <span id="valSound">{{ soundStatus.level }}</span>
                                </div>
                            </div>    
                    </td>
                    <td style="text-align:center">
                        <select v-model="soundStatus.volOsdEnabled">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>muted </option>
                            <option value=false>false </option>
                        </select>   
                    </td>
                    <td style="text-align:center">
                        <a @click.prevent="setVolumeLevel" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
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
                soundMode:{
                    mode:"",
                    balance:0
                },
                soundOut:{
                    speakerType:""
                },
                soundStatus:{
                    level:0,
                    muted:true,
                    externalSpeaker:true,
                    volOsdEnabled:false
                }
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
                    if(payload.request.function == "getSoundMode"){ 
                        this.soundMode=payload.message;
                        if(payload.message.mode=="standard"){
                            this.soundMode.mode="Standard"
                        }
                        if(payload.message.mode=="movie"){
                            this.soundMode.mode="Cinema"
                        }
                        if(payload.message.mode=="news"){
                            this.soundMode.mode="ClearVoice"
                        }
                        if(payload.message.mode=="sports"){
                            this.soundMode.mode="Sports"
                        }
                        if(payload.message.mode=="music"){
                            this.soundMode.mode="Music"
                        }
                        if(payload.message.mode=="game"){
                            this.soundMode.mode="Game"
                        }
                        console.log(this.soundMode)
                    };  
                    if(payload.request.function == "getSoundOut"){
                        if(payload.message.speakerType=="tv_speaker"){
                            this.soundOut.speakerType="SignageSpeaker"
                        } 
                        if(payload.message.speakerType=="bt_soundbar"){
                            this.soundOut.speakerType="LGSoundSync"
                        } 
                        console.log(this.soundOut)} 
                    if(payload.request.function == "getSoundStatus"){this.soundStatus=payload.message; console.log(this.soundStatus)} 
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            getSoundMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getSoundMode" }`})
            },
            getSoundOut(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getSoundOut" }`})
            },
            getSoundStatus(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getSoundStatus"}`})
            },
            setExternalSpeaker(){
                var comando=`{
                    "func": "setExternalSpeaker",
                    "options":{
                        externalSpeaker: ${this.soundStatus.externalSpeaker}
                    }
                }`
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setMuted(){
                var comando=`{
                    "func": "setMuted",
                    "options":{
                        muted:${this.soundStatus.muted}        
                    }
                }`
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setSoundMode(){
               /*El balance va de -50 a 50, los valores negativos son 
               *para la bocina izquierda, positivos para la derecha
               */
               var comando=`{
                   "func":"setSoundMode",
                   "options":{
                       mode: Sound.SoundMode.${this.soundMode.mode},
                       balance:${this.soundMode.balance}
                   }
               }`
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setSoundOut(){
               var comando=`{
                   "func": "setSoundOut",
                   "options":{
                       speakerType:Sound.SpeakerType.${this.soundOut.speakerType}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setVolumeLevel(){
               var comando=`{
                   "func": "setVolumeLevel",
                   "options":{
                       level:${this.soundStatus.level},
                       volOsdEnabled:${this.soundStatus.volOsdEnabled}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           }
        }
    })
</script>
