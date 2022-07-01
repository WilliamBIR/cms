<template>
    <div>
        <div>
            <h3>Configuracion</h3>
        </div>

        <div>
            <h4 style="text-align:center; font-size:30px">Lenguage del Menu</h4>
            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getOSDLanguage" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input v-model="this.specifier" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>             
                        <td style="text-align:center"><a @click="setOSDLanguage" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                        
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <h4 style="text-align:center; font-size:30px">Bloqueo del menu</h4>
            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getOSDLock" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td style="text-align:center">
                            <select v-model="this.osdLock">
                                <option selected disabled>Selecciona una opcion</option>
                                <option value=false>Apagar </option>
                                <option value=true>Encender </option>
                            </select>
                        </td>             
                        <td style="text-align:center"><a @click="setOSDLock" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div>
            <h4 style="text-align:center; font-size:30px">Picture Mode</h4>

            <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getPictureMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td style="text-align:center">
                        <select v-model="picturemode" >
                            <option value="APS">Eco </option>
                            <option value="CINEMA">Cinema </option>
                            <option value="EXPERT1">Expert 1 </option>
                            <option value="EXPERT2">Expert 2 </option>
                            <option value="GAME">Game </option>
                            <option value="SPORTS">Sports </option>
                            <option value="STANDARD">Normal </option>
                            <option value="VIVID">Vivid </option>
                        </select>            
                        </td>             
                        <td style="text-align:center"><a @click="setPictureMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <h4 style="text-align:center; font-size:30px">Proxy Bypass</h4> 
           <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getProxyBypassList" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td style="text-align:center">
                            <div v-for="(url,idx) in urlList" :key="url">
                                <p>
                                <input v-model="url.value"  type="text"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring text-center">
                                <a @click.prevent="deleteUrl(idx)" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition ml-4">X</a>         
                                </p>
                            </div>
                            <a @click.prevent="addUrl()" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">+</a>         
                        </td>             
                        <td style="text-align:center"><a @click="setProxyBypassList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
                        
        <div>
            <h4 style="text-align:center; font-size:30px">Server Properties</h4>



           <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ip</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Puerto</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Conexion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">App Launch Mode</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">AppType</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">fqdn Mode</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">fqdn Addr</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                    
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getServerProperty" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input v-model="this.serverproperties.serverIp" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>             
                        <td class="px-2 py-2 whitespace-nowrap"><input v-model="this.serverproperties.serverPort" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>             
                        <td class="px-2 py-2 whitespace-nowrap"><select v-model="serverproperties.secureConnection">
                                <option value=false>Http </option>
                                <option value=true>HTTPS </option>
                            </select>
                        </td>

                         <td class="px-2 py-2 whitespace-nowrap"><select v-model="serverproperties.appLaunchMode">
                                <option value="none">None </option>
                                <option value="LOCAL">Local Storage </option>
                                <option value="USB">USB Flash Drive </option>
                                <option value="REMOTE">Remote Server </option>
                            </select>
                         </td>

                        <td class="px-2 py-2 whitespace-nowrap"><select v-model="serverproperties.appType">
                            <option value="Configuration.AppType.ZIP">ZIP </option>
                            <option value="Configuration.AppType.IPK">IPK </option>
                        </select>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap"><select v-model="serverproperties.fqdnMode">
                            <option value=false>Use FQDN </option>
                            <option value=true>Ip Address and port number </option>
                        </select>
                        </td>
                        <td class="px-2 py-2 whitespace-nowrap"><input v-model="this.serverproperties.fqdnAddr" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>             
                        
                        <td style="text-align:center"><a @click="setServerProperty" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <h4 style="text-align:center; font-size:30px">Usb Lock</h4>

            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getUSBLock" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td  style="text-align:center">
                            <select v-model="usblock">
                            <option value=false>desbloqueado </option>
                            <option value=true>bloqueado </option>
                            </select> 
                        </td>             
                        <td style="text-align:center"><a @click="setUSBLock" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div>
            <h4 style="text-align:center; font-size:30px">Lenguaje Teclado virtual (aun no funciona)</h4>
            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getVirtualKeyboardLanguage" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td style="text-align:center">
                            <div v-for="(tecla,idtecla) in languageCodeList" :key="tecla">
                                <p>
                                <input v-model="tecla.value"  type="text"  class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring text-center">
                                <a @click.prevent="deleteteclavir(idtecla)" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition ml-4">X</a>         
                                </p>
                            </div>
                            <a v-if="languageCodeList.length<2" @click.prevent="addteclavir()" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">+</a>         
                        </td>            
                        <td style="text-align:center"><a @click="setVirtualKeyboardLanguage" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                    </tr>
                </tbody>
            </table>

        </div>            


        <div>
            <h4 style="text-align:center; font-size:30px">Texto Predictivo teclado virtual (Aun no)</h4>
            
            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getVirtualKeyboardPredictiveText" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td style="text-align:center">
                            <select v-model="this.predictiveText">
                                <option value=on>encendido </option>
                                <option value=off>apagado </option>
                            </select> 
                        </td>             
                        <td style="text-align:center"><a @click="setVirtualKeyboardPredictiveText" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                        
                    </tr>
                </tbody>
            </table>            

        </div>
            
        <div>
            <h4 style="text-align:center; font-size:30px">Alias</h4>

            <table  class="min-w-full divide-y divide-gray-200" role="grid">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Informacion</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambiar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr  class="drag" role="row">
                        <td style="text-align:center"><a @click="getProperty" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a></td>
                        <td class="px-2 py-2 whitespace-nowrap"><input v-model="this.properties.alias" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>             
                        <td style="text-align:center"><a @click="setProperty" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Actualizar</a></td>
                        
                    </tr>
                </tbody>
            </table>

        </div>


        <div style="text-align:center">            
            <h4 style="text-align:center; font-size:30px">Reiniciar aplicación</h4>
            <a @click.prevent="restartApplication" class=" items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-300 active:bg-orange-600 focus:outline-none focus:border-orange-700 focus:ring focus:ring-orange-200 disabled:opacity-25 transition ml-4">Reiniciar</a>         
        
        </div>

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
                specifier:null, 
                /*timeZone:{
                    continent:null,
                    country:null,
                    city:null
                }, */
                osdLock:false,
                picturemode:null,
                urlList:[],
                properties:{
                    alias:"",
                    key_delivery_to_simplink:""
                },
                serverproperties:{
                    serverIp:"0.0.0.0",
                    serverPort:null,
                    secureConnection:null,
                    appLaunchMode:null,
                    fqdnMode:false,
                    fqdnAddr:null,
                    appType:null,
                },
                //timeZoneList:[],
                usblock:null,
                languageCodeList:[],
                predictiveText:false,
                alias:null,
                
            }
        },
        beforeMount(){
            console.log('montando Configuration')        
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
                    if(payload.request.function == "getOSDLanguage"){ this.specifier=payload.message.specifier;console.log(this.specifier)};
                    if(payload.request.function == "getTimeZone"){ 
                        this.timeZone=payload.message.timeZone
                        console.log(this.timeZone)
                    }
                    if(payload.request.function == "getOSDLock"){ this.osdLock=payload.message.enabled;console.log(this.osdLock)};
                    if(payload.request.function == "getProperty"){ this.properties=payload.message;console.log(this.properties)};
                    if(payload.request.function == "getPictureMode"){ 
                        if(payload.message.mode=="eco"){
                                this.picturemode="APS"
                        }
                        if(payload.message.mode=="cinema"){
                                this.picturemode="CINEMA"
                        }
                        if(payload.message.mode=="expert1"){
                                this.picturemode="EXPERT1"
                        }
                        if(payload.message.mode=="expert2"){
                                this.picturemode="EXPERT2"
                        }
                        if(payload.message.mode=="game"){
                                this.picturemode="GAME"
                        }
                        if(payload.message.mode=="sports"){
                                this.picturemode="SPORTS"
                        }
                        if(payload.message.mode=="normal"){
                                this.picturemode="STANDARD"
                        }
                        if(payload.message.mode=="vivid"){
                                this.picturemode="VIVID"
                        }
        
                    };
                    if(payload.request.function == "getProxyBypassList"){ 
                        this.urlList=[]
                        for(var i=0; i< payload.message.urlList.length;i++){
                            this.urlList.push({value: payload.message.urlList[i]})
                        }
                        console.log(this.urlList)};
                    if(payload.request.function == "getServerProperty"){ this.serverproperties=payload.message;
                        if(this.serverproperties.appType=="zip"){
                                this.serverproperties.appType="Configuration.AppType.ZIP"
                        }
                        if(this.serverproperties.appType=="ipk"){
                                this.serverproperties.appType="Configuration.AppType.IPK"
                        }

                        if(this.serverproperties.appLaunchMode=="local"){
                                this.serverproperties.appLaunchMode="LOCAL"
                        }
                        if(this.serverproperties.appLaunchMode=="usb"){
                                this.serverproperties.appLaunchMode="USB"
                        }
                        if(this.serverproperties.appLaunchMode=="remote"){
                                this.serverproperties.appLaunchMode="REMOTE"
                        }
                        
                        console.log(this.serverproperties)};
                    if(payload.request.function == "getTimeZoneList"){ this.timeZoneList=payload.message.timeZone;console.log(this.timeZoneList)};
                    if(payload.request.function == "getUSBLock"){ this.usblock=payload.message.enabled;console.log(this.usblock)};
                    if(payload.request.function == "getVirtualKeyboardLanguage"){ 
                        this.languageCodeList=[]
      
                        for(var i=0; i<payload.message.languageCodeList.length;i++){
                            this.languageCodeList.push({value:payload.message.languageCodeList[i]})
                        }
                        console.log(this.languageCodeList)
                    };
                    if(payload.request.function == "getVirtualKeyboardPredictiveText"){ this.predictiveText=payload.message.disablePredictiveText;console.log(this.predictiveText)};
                    if(payload.request.function == "restartApplication"){ console.log("Aplicacion reiniciada")};
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            addUrl(){
                this.urlList.push({value:"*."})
            },
            deleteUrl(idx){
                this.urlList.splice(idx,1)
            },
            addteclavir(){
                this.languageCodeList.push({value:""})
            },
            deleteteclavir(idx){
                this.languageCodeList.splice(idx,1)
            },
            //Los siguientes metodos son descritos en la parte de configuracion
            //Para consultar lenguaje
            getOSDLanguage(){
                console.log('Lenguaje')
               this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getOSDLanguage" }`});
            },
            //Obtener Zona Horaria?
            getTimeZone(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getTimeZone" }`});
            },
            //Consultar bloqueo del menu
            getOSDLock(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug,message:`{ "func":"getOSDLock" }`})
            },

            //Ver picture mode
            getPictureMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{ "func":"getPictureMode" }`})
            },
            //************Tampoco sirve, hay que probar otra forma */
            getProperty(){
                //Depende de la pantalla, las opciones son: "alias", "operation_mode_after_screen_share", "key_delivery_to_simplink", "cec_device_control"

                var keys='{"keys":["alias"]}'
                console.log(keys)
                keys=JSON.stringify(keys)
                console.log(keys)
                var comando=`{
                    "func":"getProperty",
                    "options":
                        ${keys}
                    
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            
            },

            getProxyBypassList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{ "func":"getProxyBypassList" }`})
            },
            getServerProperty(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{ "func":"getServerProperty"}`})
            },
            getTimeZoneList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug,message:`{ "func":"getTimeZoneList"}`})
            },
            getUSBLock(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: `{ "func":"getUSBLock"}`})
            },
            getVirtualKeyboardLanguage(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func":"getVirtualKeyboardLanguage"}`})
            },
            //Problemas con esta**********************
            getVirtualKeyboardPredictiveText(){
                 this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func":"getVirtualKeyboardPredictiveText"}`})
            },
            restartApplication(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func":"restartApplication"}`})
            },
            setOSDLanguage(){
                var comando=`{
                    "func": "setOSDLanguage",
                    "options": {
                        specifier:"${this.specifier}",
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getOSDLanguage()},500);
            },

        /* El bloqueo del OSD implica "esconder" todas las UI y OSD, incluyendo las siguientes:
            -Settings Menu
            -Volume Control
            -Mute Control
            -No signal screen
        */
            setOSDLock(){
                var comando=`{
                    "func":"setOSDLock",
                    "options":{
                        enabled:${this.osdLock}
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getOSDLock()},500);
            },

            /* Para versiones anteriores a la 3.2:
                -Cinema= Gov./Corp
                -Game= Education
                -Sports= Transportation
                -Standard= General
                -Vivid= Mall /QSR
            */
            setPictureMode(){
                var comando=`{
                    "func":"setPictureMode",
                    "options":{
                        mode:Configuration.PictureMode.${this.picturemode}
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getPictureMode()},500);
            },

            /******************Alerta, no funciona esta aún */
            setProperty(){
                console.log(this.properties.alias)

                var keys=`{"alias":"${this.properties.alias}"}`
                console.log(keys)
                keys=JSON.stringify(keys)
                console.log(keys)


                var comando=`{
                    "func":"setProperty",
                    "options":${keys}
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            setProxyBypassList(){
                console.log(this.urlList)
                var aux="["
                console.log(this.urlList.length)
                for(var i=0; i<this.urlList.length; i++){
                    console.log(this.urlList[i])
                    aux+="'"+ this.urlList[i].value+"'"
                    if(i<this.urlList.length-1){
                        aux+=', '
                    }
                }
                aux+="]"
                console.log(aux)
                
                var comando=`{
                    "func":"setProxyBypassList",
                    "options":{
                        urlList: ${aux}
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getProxyBypassList()},1000);
                
            },

            //*********Revisar esta tambien */
            setServerProperty(){
                var comando=`{
                    "func":"setServerProperty",
                    "options":{
                        serverIp:'${this.serverproperties.serverIp}',
                        serverPort:${this.serverproperties.serverPort},
                        secureConnection:${this.serverproperties.secureConnection},
                        appLaunchMode:Configuration.AppMode.${this.serverproperties.appLaunchMode},
                        appType:${this.serverproperties.appType},
                        fqdnMode:${this.serverproperties.fqdnMode},
                        fqdnAddr:'${this.serverproperties.fqdnAddr}',
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getServerProperty()},500);
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
            },
            setUSBLock(){
                var comando=`{
                    "func":"setUSBLock",
                    "options":{
                            enabled: ${this.usblock}
                        }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getUSBLock()},500);
            },

            setVirtualKeyboardLanguage(){

                console.log(this.languageCodeList)
                var aux="["
                console.log(this.languageCodeList.length)
                for(var i=0; i<this.languageCodeList.length; i++){
                    console.log(this.languageCodeList[i])
                    aux+="'"+ this.languageCodeList[i].value+"'"
                    if(i<this.languageCodeList.length-1){
                        aux+=', '
                    }
                }
                aux+="]"
                console.log(aux)
                var comando=`{
                    "func":"setVirtualKeyboardLanguage",
                    "options":{
                            languageCodeList:${aux}
                        }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getVirtualKeyboardLanguage()},500);
            },
            setVirtualKeyboardPredictiveText(){
                var comando=`{
                    "func":"setVirtualKeyboardPredictiveText",
                    "options":{
                            disablePredictiveText: "${this.predictiveText}"
                        }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
                setTimeout(()=>{this.getVirtualKeyboardPredictiveText()},1000);
            }


        }
    })
</script>
