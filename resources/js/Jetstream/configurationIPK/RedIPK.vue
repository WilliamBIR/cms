<template>
    <div>
        <h3>Información de Red</h3>
    </div>
    <!-- INFO internet-->
    <div>
        <table class="table-fixed">
                <thead> <p>Información Cableado</p>
                <tr>
                    <th>Caracteristica</th>
                    <th>valor</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <td>Estado</td> <td>{{ wired.state }}</td></tr>
                    <tr> <td>Cableado</td><td>{{ wired.plugged }}</td></tr>
                    <div v-if="wired.plugged">
                        <tr> <td>Internet</td><td>{{ wired.onInternet }}</td></tr>
                        <tr> <td>IP</td><td>{{ wired.ipAddress }}</td></tr>
                        <tr> <td>DNS</td><td>{{ wired.dns1 }}</td></tr>
                        <tr> <td>Gateway</td><td>{{ wired.gateway }}</td></tr>
                        <tr> <td>Metodo</td><td>{{ wired.method }}</td></tr>
                        <tr> <td>Mascara</td><td>{{ wired.netmask }}</td></tr>
                        <tr> <td>Interfaz</td><td>{{ wired.interfaceName }}</td></tr>
                    </div>
                    
                    
                </tbody> 
        </table>
    </div>
    
    <div>
        <table class="table-fixed">
                <thead> <p>Información Wifi</p>
                <tr>
                    <th>Caracteristica</th>
                    <th>valor</th>
                </tr>
                </thead>
                <tbody>
                    <tr> <td>Estado</td> <td>{{ wifi.state }}</td></tr>
                    <div v-if="wifi.state != 'disconnected'">
                        <tr> <td>Internet</td><td>{{ wifi.onInternet }}</td></tr>
                        <tr> <td>IP</td><td>{{ wifi.ipAddress }}</td></tr>
                        <tr> <td>DNS</td><td>{{ wifi.dns1 }}</td></tr>
                        <tr> <td>Gateway</td><td>{{ wifi.gateway }}</td></tr>
                        <tr> <td>Metodo</td><td>{{ wifi.method}}</td></tr>
                        <tr> <td>Mascara</td><td>{{ wifi.netmask}}</td></tr>
                        <tr> <td>Interfaz</td><td>{{ wifi.interfaceName}}</td></tr>
                        <tr> <td>ssid</td><td>{{ wifi.displayName }}</td></tr>
                    </div>
                </tbody> 
        </table>
    </div>
    <!-- info blue -->
    <div v-if="wired">
        <table class="table-fixed">
                <thead> Bluetooth
                <tr><th>Caracteristica</th><th>valor</th></tr>
                </thead>
                <tbody>
                    <tr> <td>Habilitado</td> <td>{{ bluetooth.tetheringEnabled }}</td></tr>
                    <tr> <td>Estado</td><td>{{ bluetooth.state }}</td></tr>
                </tbody> 
        </table>
    </div>
    <!-- info mac -->
    <div v-if="mac.wifiInfo">
        <table class="table-fixed">
                <thead> Dirección MAC
                <tr><th>Caracteristica</th><th>valor</th></tr>
                </thead>
                <tbody>
                    <tr> <td>MAC Wifi</td> <td>{{ mac.wifiInfo.macAddress}}</td></tr>
                    <tr> <td>MAC Cable</td><td>{{ mac.wiredInfo.macAddress }}</td></tr>
                </tbody> 
        </table>
    </div>
    <!-- REVISAR LISTA DE WIFI -->
    <div class="rounded-md bg-gray-300">
        <h3>Escaneo de Wifi</h3>
         <div class="col-xs-5">
                <jet-button class="bg-red-800 hover:bg-red-700 mx-2" @click="getWifiList()" >
                        Scan Wifi
                </jet-button>
        </div>
        <table class="table-fixed">
                <thead> Dirección MAC<tr><th>SSID</th><th>Potencia</th></tr></thead>
                <tbody>
                    <tr v-for="({ssid, signalLevel}, i) in wifiList" :key="i"> 
                        <td>{{ ssid }}</td><td>{{ signalLevel }}</td>
                    </tr>
                </tbody>  
        </table>
    </div> 
    <!-- CONEXION DE WIFI -->
    <div class="rounded-md bg-gray-200">
        <h3>Conexión de Wifi</h3>
        <div>
            <select v-model="redWifi">
                <option disabled value="">Wifi</option>
                <option v-for="({ssid},i) in wifiList" :key="i" v-bind:value="ssid">{{ssid}}</option>
            </select>
            <span v-bind:style="{ 'background-color': 'gray', 'border': 'solid '}">Conectar a: {{redWifi}}</span>
        </div>

        <div>
            <input type="password" v-model="passwordWifi" placeholder="Password">
        </div>
        <div class="col-xs-5">
                <jet-button class="bg-red-800 hover:bg-red-700 mx-2" @click="connectWifi()">Conectar</jet-button>
        </div>
    </div> 
    <!-- CAMBIAR IP -->
    <div class="rounded-md bg-gray-500">
        
        <div class="flex justify-start items-center rounded-md bg-gray-500">
            <label class="mx-2">
                <!-- <input type="radio" name="localApp" value="cable" checked="" data-original-title="" title="" @click="changeNetwork(value)" /> -->
                Habilitar Cable
                <input type="radio" name="wired" checked=""  data-original-title="" title="" v-model="wiredEnable"/>                
            </label>
            <select v-model="wiredMethod">
                <option disabled value="">Cableado</option>
                <option v-for="i in optionNetwork" :key="i" v-bind:value="i">{{i}}</option>
            </select>
            <span v-bind:style="{ 'background-color': 'gray', 'border': 'solid '}">Conectar a: {{wiredMethod}}</span>
            
            <div v-if="wiredMethod == 'manual'">
                <label class="radio upgrade-label">Propiedades de IP estatica de cable</label>
                <div class="flex justify-between items-center">
                    <input id="input1" class="border-2 rounded w-3/4" placeholder="Ponga IP" v-model="wired.ipAddress"/>
                    <input id="input2" class="border-2 rounded w-3/4" placeholder="Ponga DNS" v-model="wired.dns1"/>
                    <input id="input3" class="border-2 rounded w-3/4" placeholder="Ponga Gateway" v-model="wired.gateway"/>
                    <input id="input4" class="border-2 rounded w-3/4" placeholder="Ponga Mascara" v-model="wired.netmask"/>
                    <jet-button class="bg-red-800 hover:bg-red-700 mx-2" @click="changeNetwork()">
                        Cambiar
                    </jet-button>
                </div>
            </div>
        </div>

        <div class="flex justify-start items-center rounded-md bg-gray-500">
            <label class="mx-2">
                Habilitar Wifi
                <input type="radio" name="wifi" checked=""  data-original-title="" title="" v-model="wifiEnable" />
            </label>
            <select v-model="wifiMethod">
                <option disabled value="">Wifi</option>
                <option v-for="i in optionNetwork" :key="i" v-bind:value="i">{{i}}</option>
            </select>
            <span v-bind:style="{ 'background-color': 'gray', 'border': 'solid '}">Conectar a: {{wifiMethod}}</span>
            <div v-if="wifiMethod == 'manual'">
                <label class="radio upgrade-label">Propiedades de IP estatica de Wifi</label>
                <div class="flex justify-between items-center">
                    <input id="in" class="border-2 rounded w-3/4" placeholder="Ponga IP" v-model="wifi.ipAddress"/>
                    <input id="in1" class="border-2 rounded w-3/4" placeholder="Ponga DNS1" v-model="wifi.dns1"/>
                    <input id="in2" class="border-2 rounded w-3/4" placeholder="Ponga Gateway" v-model="wifi.gateway"/>
                    <input id="in3" class="border-2 rounded w-3/4" placeholder="Ponga Mascara" v-model="wifi.netmask"/>
                    <jet-button class="bg-red-800 hover:bg-red-700 mx-2" @click="changeNetwork()">
                        Cambiar
                    </jet-button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import { defineComponent } from 'vue';
    import JetButton from "@/Jetstream/Button.vue";
    export default defineComponent({
        components:{
            JetButton
        },
        props:["slug"],
        data(){
            return{
                wired: false,
                wifi: false,
                bluetooth: false,
                mac:{
                    wifiInfo: null,
                    wiredInfo: null
                },
                wifiList: [],
                redWifi: null,
                passwordWifi: null,
                optionNetwork: ["dhcp", "manual"],
                wiredMethod: 'dhcp',
                wifiMethod: 'dhcp',
                wiredEnable: true,
                wifiEnable: true,
            }
        },
        beforeMount(){
            this.getInfoRed();
            setTimeout(()=>{this.getNetworkMacInfo()},500);
        },
        computed:{
            chosenWidth() {
                return this.widthMappings[this.selectedOption] || '1px'
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
                    if(payload.request.function == "getNetworkInfo"){this.wifi = payload.message.wifi; this.wired = payload.message.wired; this.bluetooth = payload.message.bluetooth}
                    this.mac = payload.request.function == "getNetworkMacInfo" ? payload.message : this.mac;
                    this.wifiList = payload.request.function == "getWifiList" ? payload.message.networkInfo : this.wifiList;
                }  
            }.bind((this)));
        }, 
        methods:{
            getInfoRed(){ this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getNetworkInfo" }`}); },
            getNetworkMacInfo(){ this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getNetworkMacInfo" }`}); },
            getWifiList(){ this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getWifiList" }`}); },
            connectWifi(){
                if(this.redWifi == null || this.passwordWifi == null){return}
                const options = `{
                        "func": "connectWifi",
                        "options": {
                            ssid: "${this.redWifi}",
                            password: "${this.passwordWifi}",
                            }
                        }`;
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: options});
            },
            changeNetwork(){
                let options= `{
                    "func": "setNetworkInfo",
                    "options": {
                        wired: {
                            enabled: ${this.wiredEnable},
                            method: "${this.wiredMethod}",
                            ipAddress: "${this.wired.ipAddress}",
                            netmask: "${this.wired.netmask}",
                            gateway: "${this.wired.gateway}",
                            dns1: "${this.wired.dns1}",
                            dns2: "8.8.8.8"
                            },
                        wifi: {
                            enabled: ${this.wiredEnable},
                            method: "${this.wifiMethod}",
                            ipAddress: "${this.wifi.ipAddress}",
                            netmask: "${this.wired.netmask}",
                            gateway: "${this.wired.gateway}",
                            dns1: "${this.wired.dns1}",
                            dns2: "8.8.8.8"
                            }
                    }
                }`;
                this.$inertia.socket.emit("mensaje", {uid: this.slug,message: options});
            }
        }
    })
</script>
