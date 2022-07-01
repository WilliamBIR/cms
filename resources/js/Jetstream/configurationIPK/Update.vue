<template>
        <h3>Información de dispositivo</h3>
    <div v-if="infoSoftware">
        <table class="table-fixed">
                <thead> <p>Información Software</p>
                <tr>
                    <th>Caracteristica</th><th>valor</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <td>Firmware</td> <td>{{ infoSoftware.firmwareVersion }}</td> </tr>
                    <tr> <td>Hardware</td><td>{{ infoSoftware.hardwareVersion }}</td></tr>
                    <tr> <td>Modelo</td><td>{{ infoSoftware.modelName }}</td></tr>
                    <tr> <td>SDK</td><td>{{ infoSoftware.sdkVersion }}</td></tr>
                    <tr> <td>Serial</td><td>{{ infoSoftware.serialNumber }}</td></tr>
                </tbody> 
        </table>
   </div>
   <div v-if="infoHardware">
        <table class="table-fixed">
                <thead> <p>Información Hardware CPU</p>
                <tr>
                    <th>CPU</th><th></th><th>Reloj</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="({model,times}, i) in infoHardware.cpus" :key="i"> 
                        <td>CPU</td> <td>{{ model }}</td> 
                         <td>idle</td> <td>{{ times.idle }}</td>
                         <td>irq</td> <td>{{ times.irq }}</td>
                         <td>nice</td> <td>{{ times.nice }}</td>
                         <td>sys</td> <td>{{ times.sys }}</td>
                         <td>user</td> <td>{{ times.user }}</td>
                    </tr>
                </tbody> 
        </table>
        <!-- MEMORIA -->
        <table class="table-fixed">
                <thead> <p>Información de Memoria</p>
                <tr>
                    <th>Caracteristica</th><th>valor</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <td>Bufer</td> <td>{{ changeValue.buffer }} GB</td> </tr>
                    <tr> <td>Cache</td><td>{{ changeValue.cached }} GB</td></tr>
                    <tr> <td>Disponible</td><td>{{ changeValue.free }} GB</td></tr>
                    <tr> <td>Total</td><td>{{ changeValue.total }} GB</td></tr>
                    <tr> <td>Usado</td><td>{{ changeValue.used }} GB</td></tr>
                </tbody> 
        </table>

        <table class="table-fixed">
                <thead> <p>Información de Memoria Interna</p>
                <tr>
                    <th>Caracteristica</th><th>valor</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <td>Libre</td> <td>{{ storageInfo.free/1000000 }} GB</td> </tr>
                    <tr> <td>Usada</td><td>{{ storageInfo.used/1000000 }} GB</td></tr>
                    <tr> <td>Total</td><td>{{ storageInfo.total/1000000 }} GB</td></tr>

                </tbody> 
        </table>
   </div>
   <!-- FIRMWARE -->


    <div>
        <div class="h-2/5">
            <!-- <label class="radio upgrade-label">Actualizar Firmware</label> -->
            <h1>Actualiza Firmware</h1>
            <!-- div class="flex justify-between items-center">
                <form @submit.prevent="submit" id="formVid" class="form-group pt-3" enctype="multipart/form-data">
                    <div class="flex justify-center flex-wrap border border-gray-300 overflow-auto max-h-100">
                        <input type="file" ref="logo"  @change="onFileSelected"   accept=".ipk , .jpg"/>
                    
                    </div>
                    <div align="center" class="mt-5">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div-->

            <div>
                <p> Url de la actualización <input type="text"  name="Properties" v-model="this.uri"></p>
                <button type="button"  @click.prevent="downloadFirmware" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                    Enviar Epk
                </button>            
            </div>


            <!-- <hr class="col-xs-12" /> -->
            <div class="flex justify-between items-center my-2">
                <label class="radio upgrade-label">Descarga de Firmware</label>
                <div class="progress">
                    <div id="progressFWDownload" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="50" aria-valuemax="100" onchange="">
                        {{this.firmwareStatus.downloadProgress}}%
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center my-2">
                <label class="radio upgrade-label">Actualización de Firmware</label>
                <div class="progress" id="progressbarUpgrade">
                    <div id="progressFWUpgrade" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" onchange="">
                        {{this.firmwareStatus.upgradeProgress}}%
                    </div>
                </div>
            </div>
            <!-- <jet-button class="bg-red-800 hover:bg-red-700 mx-2 h-7" @click="InfoFirmware()">Refrescar</jet-button> -->
            <button type="button"  @click.prevent="getFirmwareUpgradeStatus" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                Refrescar
            </button>
            <!--button type="button"  @click.prevent="getStorageInfo" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                Recargar Memoria
            </button -->
            <button type="button"  @click.prevent="upgradeFirmware" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                upgradeFirmware
            </button>
            
        </div>
        <hr>
    </div>


    <!--div v-if="getServerProperty">
        <h3 class="h-1/3">Configuración de Aplicaciones</h3>
        <div class="h-1/3">
            <div> 
                <h3>Tipo de Aplicación</h3>
                <label class="mx-2"><input type="radio" id="ipk" value="ipk" v-model="getServerProperty.appType" /> IPK </label>
                <label class="mx-2"><input type="radio" id="zip" value="zip" v-model="getServerProperty.appType"/> ZIP </label>
                <h3>Ejecución de Aplicación</h3>
                <label class="mx-2"><input type="radio" id="valLocal" value="local" v-model="getServerProperty.appLaunchMode"/> Local
                </label>
                <label class="mx-2"><input type="radio" id="valusb" value="usb" v-model="getServerProperty.appLaunchMode"/> USB
                </label>
                <label class="mx-2"><input type="radio" id="valServidors" value="remote" v-model="getServerProperty.appLaunchMode"/> Servidor
                </label>
                <div>
                    <form @submit.prevent="setServerProperty" id="formInsta" class="form-group pt-3">
                        <div class="justify-center flex-wrap border border-gray-300 overflow-auto max-h-100" v-if="getServerProperty.appLaunchMode == 'remote'">
                            Servidor:<input type="text" placeholder="URL Servers" v-model="getServerProperty.serverIp"/>
                            Ruta:<input type="text" placeholder="URL Servers" v-model="getServerProperty.serverPort"/>
                        </div>
                        <div align="center" class="mt-5">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                                Configurar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
        </div>
        <div>
            <h3>Instalar aplicación via remota(IPK/ZIP)</h3>
            <div>
                <h5>Alojamiento de App</h5>
                <label class="mx-2"><input type="radio" id="eusb" value="LOCAL" v-model="applica.storage"/> USB</label>
                <label class="mx-2"><input type="radio" id="eremoto" value="USB" v-model="applica.storage"/> Remoto</label>
            </div>
            <div>
                <h5>Tipo de App</h5>
                <label class="mx-2"><input type="radio" id="eusb" value="IPK" v-model="applica.type"/> IPK </label>
                <label class="mx-2"><input type="radio" id="eremoto" value="ZIP" v-model="applica.type"/> ZIP </label>
            </div>
            <div class="flex justify-between items-center">
                <form @submit.prevent="updateAplicacion" id="formInsta" class="form-group pt-3">
                    <div class="flex justify-center flex-wrap border border-gray-300 overflow-auto max-h-100">
                        <input type="file" @change="onFileSelected" accept=".ipk, .zip"/>
                    </div>
                    <div align="center" class="mt-5">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">
                            Instalar
                        </button>
                    </div>
                </form>
            </div>
            <hr>
        </div>
    </div-->

</template>

<script>
    import { defineComponent } from 'vue';
    import JetButton from '@/Jetstream/Button.vue';

    export default defineComponent({
        components:{
            JetButton
        },
        props:['view', 'slug'],
        data(){
            return{
                infoSoftware: null,
                infoHardware: null,
                img: null,
                pathFirmware: null,
                firmwareStatus:{
                    downloadProgress: 0,
                    upgradeProgress: 0,
                    status: null
                },
                selectedFileFirmware: null,
                getServerProperty: null,
                appIpk: null,
                upgradeApp: {
                    to: null,
                    recovery: false,
                    type: "ipk"
                },
                applica:{
                    storage:'USB',
                    type:'IPK'
                },
                form: this.$inertia.form({
                    '_method':'PUT',
                    data:null
                }),
                uri:"",
                storageInfo:{
                    free:0,
                    total:0,
                    used:0,
                }              
            }
        },
        beforeMount(){
            this.getInfoDevice();
            setTimeout(()=>{this.getInfoProcess()}, 500);
            setTimeout(()=>{this.InfoServerProperty()}, 750);
            setTimeout(()=>{this.getStorageInfo()}, 1500);
        },
        computed:{
            changeValue(){
                console.log("changeValue");
                if(this.infoHardware){
                    let data = {};
                    for(let i in this.infoHardware.memory){data[i] = this.infoHardware.memory[i]/1000000000;}
                    return data
                }else return 0;
            }
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
                    if(payload.request.function == "getPlatformInfo"){this.infoSoftware = payload.message}
                    else if(payload.request.function == "getSystemUsageInfo"){this.infoHardware = payload.message}
                    else if(payload.request.function == "getFirmwareUpgradeStatus"){this.firmwareStatus = payload.message; console.log(this.firmwareStatus)}
                    else if(payload.request.function == "getServerProperty"){this.getServerProperty = payload.message}
                    else if(payload.request.function == "getStorageInfo"){this.storageInfo = payload.message
                        
                    }

            }  
            }.bind((this)));
        },
        methods:{
            getInfoDevice(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getPlatformInfo" }`})},
            getInfoProcess(){this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getSystemUsageInfo", "options": { cpus: true, memory: true } }`})},
//            InfoFirmware(){this.$inertia.socket.emit("mensaje", {uid: this.slug, message: `{"func": "getFirmwareUpgradeStatus"}`})},
            InfoServerProperty(){
                this.$inertia.socket.emit("mensaje", {uid: this.slug, message: `{"func": "getServerProperty"}`})
            },
            /*
            upgradeFirmware(){
                console.log(this.pathFirmware);
                const dataFirmware = `{"func": "downloadFirmware","options": { uri: '${this.pathFirmware}'}}`;
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: dataFirmware});
            },
            */
            upgradeApplication() {
                const options = `{
                    "func": "upgradeApplication",
                    "options": {
                        "type": Storage.AppType.IPK,
                        "to": Storage.AppMode.LOCAL,
                        "recovery": false
                    }
                }`;
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: options,});
            },
            setServerProperty(){
                let launch = {"local": "LOCAL","usb": "USB","remote": "REMOTE"}
                let tipoApp = {"ipk": "IPK","zip": "ZIP"}
                const options = `{
                    "func": "setServerProperty",
                    "options": {
                    "serverIp": "${this.getServerProperty.serverIp}",
                    "serverPort": ${this.getServerProperty.serverPort},
                    "secureConnection": false,
                    "appLaunchMode": Configuration.AppMode.${launch[this.getServerProperty.appLaunchMode]},
                    "appType": Configuration.AppType.${tipoApp[this.getServerProperty.appType]},
                    "fqdnMode": true,
                    "fqdnAddr": "${this.getServerProperty.fqdnAddr}"
                    }
                }`;
                console.log(options);
                this.$inertia.socket.emit('mensaje',{uid:this.slug, message:options})
            },
            onFileSelected(){
                /*
                if(!evt.target.files[0]){return}
                // VERIFICAMOS SI EL FIRMWARE ES DE TIPO .epk
                if(evt.target.files[0].name.includes('.jpg') || evt.target.files[0].name.includes('.ipk')){
                   this.selectedFileFirmware = evt.target.files[0]; 
                }
                else if(evt.target.files[0].name.includes('com.lg.app.signage.ipk') || evt.target.files[0].name.includes('com.lg.app.signage.zip')){
                    console.log("Se cargo una APP al sistema");
                    this.appIpk = evt.target.files[0]; 
                }
                
                else{ console.log("El archivo "+evt.target.files[0].name+" es incorrecto");}
                */
                const logo = this.$refs.logo.files[0];
                if (! logo){
                    console.log('no hay nada')
                    return;  
                } 
                const reader = new FileReader();
/*                reader.onload = (e) => {
                    this.logoPreview = e.target.result;
                };
*/              reader.readAsDataURL(logo);
                this.form.data = logo;
            }
            ,
            submit(){
                if(!this.form.data){return}
                console.log(this.form.data);
                console.log("Boton precionado");
                this.form.post(route('superprueba'),{

                })
                /*
                this.$inertia.visit('/subiripk', {
                     method: 'post',
                     data: this.selectedFileFirmware,
                     onFinish: ()=>{
                         console.log("Se cargo firmare y se procedera a envia a ipk");
                     }
                 });
                 */
            },
            updateAplicacion(){
                console.log('intentando actualizar')

            },
            downloadFirmware(){
                var comando=`{
                    "func":"downloadFirmware",
                    "options":{
                        uri:"${this.uri}"
                    }
                }`
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            getFirmwareUpgradeStatus(){
                this.$inertia.socket.emit('mensaje',{uid:this.slug, message:`{"func": "getFirmwareUpgradeStatus"}`})
            },
            getStorageInfo(){
                this.$inertia.socket.emit('mensaje',{uid:this.slug, message:`{"func": "getStorageInfo"}`})
            },
            upgradeFirmware(){
                this.$inertia.socket.emit('mensaje',{uid:this.slug, message:`{"func": "upgradeFirmware"}`})
            },


        }
    })
</script>
