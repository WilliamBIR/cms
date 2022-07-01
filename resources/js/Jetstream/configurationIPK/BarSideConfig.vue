<template>
    <div class="my-4 flex">
        <jet-button
            class="bg-yellow-700 hover:bg-yellow-600 mx-2"
            @click="reiniciarApp()"
        >
            Reiniciar App
        </jet-button>
        <jet-button
            class="bg-green-900 hover:bg-green-700 mx-2"
            @click="reiniciar()"
        >
            Reiniciar
        </jet-button>
        <label class="mx-2 flex items-center" id="labelRotation"
            >Rotation</label
        >
        <div class="mx-2 relative">
            <button
                class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-l text-white dropdown-toggle"
                type="button"
                id="dropdownMenu"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                {{ rotacion }}
            </button>
            <button
                class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-r text-white dropdown-toggle"
                data-toggle="dropdown"
            >
                <span class="caret"></span>
            </button>
            <ul class="z-10 bg-white dropdown-menu">
                <li><a @click="PortraitControl('off')">Off</a></li>
                <li><a @click="PortraitControl(90)">90º</a></li>
                <li><a @click="PortraitControl(180)">180º</a></li>
                <li><a @click="PortraitControl(270)">270º</a></li>
            </ul>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/3">
            <div class="slidecontainer col-xs-12">
                <input type="range" min="1" max="100" v-model="iluminacion" class="slider" id="rangeBacklight" @change=" PicturePropertyControl({ iluminacion: iluminacion }) " />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Iluminacion</div>
                    <div class="w-1/4 slider-value">
                        <span id="valBacklight">{{ iluminacion }}%</span>
                    </div>
                </div>
                <input
                    type="range"
                    min="1"
                    max="100"
                    v-model="brillo"
                    class="slider"
                    id="rangeBrightness"
                    @change="PicturePropertyControl({ brillo: brillo })"
                />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Brillo</div>
                    <div class="w-1/4 slider-value">
                        <span id="valBrightness">{{ brillo }}%</span>
                    </div>
                </div>
                <input
                    type="range"
                    min="1"
                    max="100"
                    v-model="contraste"
                    class="slider"
                    id="rangeContrast"
                    @change="PicturePropertyControl({ contraste: contraste })"
                />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Contraste</div>
                    <div class="w-1/4 slider-value">
                        <span id="valContrast">{{ contraste }}%</span>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="w-11/12 flex items-center">
                        <input
                            type="range"
                            min="1"
                            max="100"
                            v-model="sonido"
                            class="slider"
                            id="rangeSound"
                            @change="soundControl(sonido)"
                        />
                    </div>
                    <div class="w-1/12 flex items-center">
                        <button
                            class="ml-2 w-3/4 h-7 mute sound"
                            id="btnMuted"
                            @click="SoundOnOffControl(50)"
                        ></button>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="w-3/4 slider-label" id="sliderLabelSound">
                        Volumen
                    </div>
                    <div class="w-1/4 slider-value" id="sliderValueSound">
                        <span id="valSound">{{ sonido }}%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/3">
            <div class="flex justify-between items-center px-16 mb-3">
                <label class="control-label col-xs-7 label-form-display"
                    >Imagen Actual</label
                >
                <div class="col-xs-5" id="divCaptureBtn">
                    <jet-button
                        class="bg-red-800 hover:bg-red-700 mx-2"
                        @click="commandOnly('captureScreen')"
                    >
                        Captura
                    </jet-button>
                </div>
            </div>
            <div
                class="w-full flex justify-center items-center"
                id="divCurrentImg"
            >
                <img class="w-108 h-60 screenshot" id="currentImage" v-bind:src="'data:image/jpg;base64,'+ipkData" />
            </div>
        </div>
        <div class="w-1/3">
            <div class="h-2/5">
                <label class="radio upgrade-label">Actualizar Firmware</label>
                <div class="flex justify-between items-center">
                    <input id="inputURL" class="border-2 rounded w-3/4" placeholder="Enter firmware download url here" v-model="pathFirmware"/>
                    <jet-button class="bg-red-800 hover:bg-red-700 mx-2" @click="upgradeFirmware()">
                        Actualizar
                    </jet-button>
                </div>
                <hr class="col-xs-12" />
                <div class="flex justify-between items-center my-2">
                    <label class="radio upgrade-label">Download Firmware</label>
                    <!-- Here I put a new button -->
                    <jet-button class="bg-red-800 hover:bg-red-700 mx-2 h-7" @click="InfoFirmware()">
                        Info Firmare
                    </jet-button>

                    <div class="progress">
                        <div id="progressFWDownload" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="50" aria-valuemax="100" onchange="">
                            {{this.firmwareStatus.downloadProgress}}%
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center my-2">
                    <label class="radio upgrade-label">Upgrade Firmware</label>
                    <div class="progress" id="progressbarUpgrade">
                        <div id="progressFWUpgrade" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" onchange="">
                            {{this.firmwareStatus.upgradeProgress}}%
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-1/2">
                <label class="col-xs-12 label-upgrade-app"
                    >Nombre de la ruta completa</label
                >
                <div class="flex justify-between items-center">
                    <input
                        id="inputFQDN"
                        required=""
                        placeholder="Enter remote server url here"
                    />
                    <button
                        type="button"
                        class="btn btn-common btn-pink btn-all"
                        id="btnUpgrade"
                        @click="upgradeControl('app')"
                    >
                        Upgrade
                    </button>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex flex-col justify-between items-start">
                        <div class="col-xs-6 label-upgrade-app">
                            Modo de Ejcución de la Aplicación
                        </div>
                        <div class="flex justify-start items-center">
                            <label class="mx-2">
                                <input
                                    type="radio"
                                    id="localOptions"
                                    name="Appmode"
                                    value="Local"
                                    checked=""
                                    @click="
                                        upgradeControl({ launchMode: 'Local' })
                                    "
                                />Local
                            </label>
                            <label class="mx-2">
                                <input type="radio" id="USBOptions" name="Appmode" value="USB" disabled="" @click=" upgradeControl({ launchMode: 'USB' }) " />USB
                            </label>
                            <label class="mx2">
                                <input type="radio" id="RemoteOptions" name="Appmode" value="Remote" disabled="" @click=" upgradeControl({ launchMode: 'Remote' })"/>Remote
                            </label>
                        </div>
                        <div class="col-xs-6 label-upgrade-app">
                            USB Application Upgrade
                        </div>
                        <div class="flex justify-start items-center">
                            <label
                                class="radio-inline radio-label-upgrade col-xs-1 upgrade-option"
                            >
                                <input
                                    type="radio"
                                    name="USBApp"
                                    value="Remote"
                                    checked=""
                                    @click="
                                        upgradeControl({ UpgradeAppUSB: 'usb' })
                                    "
                                />Remote
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between items-start">
                        <div class="col-xs-6 label-upgrade-app">
                            Actualización de la Aplicación Local
                        </div>
                        <div class="flex justify-start items-center">
                            <label class="mx-2">
                                <input
                                    type="radio"
                                    name="localApp"
                                    value="usb"
                                    checked=""
                                    data-original-title=""
                                    title=""
                                    @click="upgradeApplication(value)"
                                />
                                USB
                            </label>
                            <label class="mx-2">
                                <input
                                    type="radio"
                                    name="localApp"
                                    value="Remote"
                                    disabled=""
                                    @click="upgradeApplication(value)"
                                />
                                Remote
                            </label>
                        </div>
                        <div class="col-xs-6 label-upgrade-app">Type</div>
                        <div class="flex justify-start items-center">
                            <label class="mx-2">
                                <input
                                    type="radio"
                                    id="valIPK"
                                    name="valType"
                                    value="IPK"
                                    checked=""
                                    data-original-title=""
                                    title=""
                                    @click="upgradeControl({ tipeApp: value })"
                                />IPK
                            </label>
                            <label class="mx-2">
                                <input
                                    type="radio"
                                    id="valZIP"
                                    name="valType"
                                    value="ZIP"
                                    disabled=""
                                    data-original-title=""
                                    title=""
                                    @click="upgradeControl({ tipeApp: value })"
                                />ZIP
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

 
<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";

export default defineComponent({
    components: {
        JetButton,
    },
    props: ["slug", "dataIPK"],
    data() {
        return {
            rotacion: "Off",
            iluminacion: "50",
            brillo: "50",
            contraste: "50",
            sonido: "50",
            mute: false,
            capture: this.$page.props.capture ?? "",
            img: null,
            ipkData: null,
            pathFirmware: null,
            firmwareStatus:{
                downloadProgress: 0,
                upgradeProgress: 0,
                status: null
            }
        };
    },
    mounted() {
        let dropdown = document.querySelectorAll(".dropdown-toggle");
        dropdown.forEach((el) => {
            el.addEventListener("click", () => {
                el.parentNode.classList.toggle("open");
            });
        });

        // this.$inertia.socket.on("successIPK", function (payload) {
        //     console.log(payload);
        //     if (payload.error) {
        //         console.log(`Error en slugIPK: ${payload.uid}, error: ${JSON.stringify(payload.error.errorText)}`);
        //     } else {
        //         console.log(`Exito en slugIPK: ${payload.uid}`);
        //         var captura;
        //         captura = payload.request.function == "captureScreen" ? payload.message.data : null;
        //         this.firmwareStatus = payload.request.function == "getFirmwareUpgradeStatus" ? payload.message : [5, 10, null];
        //         this.ipkData = captura
        //     }
        // }.bind((this)));
    },
    methods: {
        InfoFirmware(){
            // this.$inertia.socket.emit("mensaje", {uid: this.slug, message: `{"func": "getFirmwareUpgradeStatus"}`})
            var option = `{
                "func": "listFiles",
                "options": {
                    "path": "file://internal/unzip"
                }
            }`
            this.$inertia.socket.emit("mensaje", {uid: this.slug, message:option})
        },
        upgradeFirmware(){
            console.log(this.pathFirmware);
            const dataFirmware = `{
                "func": "downloadFirmware",
                "options": {
                uri: '${this.pathFirmware}'
                }
            }`;
            this.$inertia.socket.emit("mensaje", { uid: this.slug, message: dataFirmware});
        },
        upgradeApplication(args) {
            var upgradeApplication1 = `{
                "func": "upgradeApplication",
                "options": {
                    "type": Storage.AppType.IPK,
                    "to": Storage.AppMode.LOCAL,
                    "recovery": false
                }
            }`;
            this.$inertia.socket.emit("mensaje", { uid: this.slug, message: upgradeApplication1,});
        },
        reiniciarApp(){ this.$inertia.socket.emit("mensaje", { uid: this.slug, message: `{"func": "restartApplication"}`,});},
        reiniciar() {
            var options = `{
                "func": "executePowerCommand",
                "options": {"powerCommand": Power.PowerCommand.REBOOT}
            }`;
            console.log("Apagando");
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: options,
            });
        },
        PortraitControl(value) {
            //potrait para mantener vertical
            // var potraitArgs = (value === "off" || value === 180 )? "OFF" : "ON";
            // var mode = (value === 180 || value === 270) ? "on" : "off";
            // var potraitArgs = "OFF";
            // var mode = "off"; 
            // var portrait = `{
            //                 "func": "setPortraitMode",
            //                 "options": {
            //                 portraitMode: Signage.OsdPortraitMode.${potraitArgs}
            //                 }
            //               }`;
             var portrait = `{
                            "func": "setPortraitMode",
                            "options": {
                            portraitMode: "off"
                            }
                          }`;
            // var mirror = `{
            //                 "func": "setMirrorMode",
            //                 "options": {
            //                 mode : "${mode}"
            //                 }
            //                }`;
            this.$inertia.socket.emit("mensaje", {uid: this.slug,message: portrait,});
            setTimeout(() => {
                // this.$inertia.socket.emit("mensaje", {uid: this.slug,message: mirror});
            }, 500);
        },
        soundControl(sonido) {
            var setVolumeLevel = `{
                "func": "setVolumeLevel",
                "options": {
                level : ${sonido},
                volOsdEnabled : true
                }
            }`;
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: setVolumeLevel,
            });
        },
        SoundOnOffControl() {
            this.mute = this.mute ? false : true;
            var setMuted = `{
                "func": "setMuted",
                "options": {
                muted : ${this.mute}
                }
            }`;
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: setMuted,
            });
        },
        PicturePropertyControl(params) {
            var { ilu, bri, contr } = params;
            this.iluminacion = ilu ? ilu : this.iluminacion;
            this.brillo = ilu ? bri : this.brillo;
            this.contraste = contr ? contr : this.contraste;
            console.log(this.iluminacion, this.brillo, this.contraste);
            var comando = `{
                            "func": "setPictureProperty",
                            "options": {
                                "backlight": ${this.iluminacion},
                                "blackLevel": "low",
                                "brightness": ${this.brillo},
                                "color": 50,
                                "colorGamut": "extended",
                                "colorTemperature": 6500,
                                "contrast": ${this.contraste},
                                "dynamicColor": "high",
                                "dynamicContrast": "low",
                                "gamma": "medium",
                                "mpegNoiseReduction": "low",
                                "noiseReduction": "medium",
                                "sharpness": 50,
                                "tint": 50,
                                }
                            }`;
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: comando,
            });
        },
        upgradeControl(evt) {
            // This address is used for app update
            var server = "192.168.100.118",
                port = 3001,
                // Ruta completa
                domainFQDN = null;
            var appMode = `{
                "func": "setServerProperty",
                "options": {
                "serverIp": "${server}",
                "serverPort": ${port},
                "secureConnection": false,
                "appLaunchMode": Configuration.AppMode.LOCAL,
                "appType": Configuration.AppType.IPK,
                "fqdnMode": true,
                "fqdnAddr": "http://192.168.100.123:9090/ipk"
                }
            }`;
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: appMode,
            });
        },
        commandOnly(evt) {
            var comando = `{
                    "func": "captureScreen",
                    "options": {
                    save : true,
                    thumbnail : false,
                    imgResolution : Signage.ImgResolution.FHD
                    }
                }`;
            this.$inertia.socket.emit("mensaje", {
                uid: this.slug,
                message: comando,
            });
        },
    },
});
</script>
