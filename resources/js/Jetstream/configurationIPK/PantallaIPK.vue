<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        Luz de fondo <span id="backlightReturn"></span>
                    </h4>
                    <hr>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="first txt_backlight">Luz de fondo</td>
                            <td class="second">
                                <input class="custom" id="backlight" type="range" min="0" max="100" style="background: linear-gradient(to right, rgb(207, 6, 82), rgb(207, 6, 82) 85%, rgb(166, 166, 166) 85%, rgb(166, 166, 166) 100%);">
                            </td>
                            <td class="third">
                                <span id="backlightVal" style="display:inline-block; width:33px;">85%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="my-4 flex">
        <label class="mx-2 flex items-center" id="labelRotation"
            >Rotation</label>
        <div class="mx-2 relative">
            <button class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-l text-white dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ rotacion }}
            </button>
            <button class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-r text-white dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="z-10 bg-white dropdown-menu">
                <li><a @click="PortraitControl('OFF')">OFF</a></li>
                <li><a @click="PortraitControl('DEGREE_90')">90º</a></li>
                <li><a @click="PortraitControl('DEGREE_180')">180º</a></li>
                <li><a @click="PortraitControl('DEGREE_270')">270º</a></li>
            </ul>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/2">
            <div class="slidecontainer col-xs-12">
                <input type="range" min="1" max="100" v-model="pantalla.backlight" class="slider" id="rangeBacklight" @change="PicturePropertyControl" />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Iluminacion</div>
                    <div class="w-1/4 slider-value">
                        <span id="valBacklight">{{ pantalla.backlight }}%</span>
                    </div>
                </div>
                <input type="range" min="1" max="100" v-model="pantalla.brightness" class="slider" id="rangeBrightness" @change="PicturePropertyControl" />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Brillo</div>
                    <div class="w-1/4 slider-value">
                        <span id="valBrightness">{{ pantalla.brightness }}%</span>
                    </div>
                </div>
                <input type="range" min="1" max="100" v-model="pantalla.contrast" class="slider" id="rangeContrast" @change="PicturePropertyControl" />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Contraste</div>
                    <div class="w-1/4 slider-value">
                        <span id="valContrast">{{ pantalla.contrast }}%</span>
                    </div>
                </div>
                <!-- color -->
                <input type="range" min="1" max="100" v-model="pantalla.color" class="slider" id="rangeContrast" @change="PicturePropertyControl" />
                <div class="flex justify-between">
                    <div class="w-3/4 slider-label">Color</div>
                    <div class="w-1/4 slider-value">
                        <span id="valContrast">{{ pantalla.color }}%</span>
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
            img: null,
            screeShot: null,
            pantalla:{
                backlight: 100,
                blackLevel: "low",
                brightness: 100,
                color: 50,
                colorGamut: "extended",
                colorTemperature: 6500, // No modificar
                contrast: 100,
                dynamicColor: "high",
                dynamicContrast: "low",
                gamma: "medium",
                mpegNoiseReduction: "low",
                noiseReduction: "medium",
                sharpness: 50,
                superResolution: "low",
                tint: 50,
            }
        };
    },
    beforeMount(){
        this.getPropiedadPantalla();
    },
    mounted() {
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
                var captura;
                this.screeShot = payload.request.function == "captureScreen" ? payload.message.data : this.screeShot;
                this.pantalla = payload.request.function == "getPictureProperty" ? payload.message : this.pantalla;
            }
        }.bind((this)));
    },
    methods: {
        PortraitControl(value){
             var portrait = `{
                            "func": "setNativePortraitMode",
                            "options": {
                            "nativePortrait": Custom.NATIVEPORTRAIT.${value}
                            }
                          }`;
            this.$inertia.socket.emit("mensaje", {uid: this.slug,message: portrait,});
        },
        getPropiedadPantalla(){
            this.$inertia.socket.emit("mensaje", {uid: this.slug,message: `{ "func": "getPictureProperty" }`});
        },
        PicturePropertyControl(params) {
            console.log(params);
            console.log(this.pantalla.backlight, this.pantalla.brightness, this.pantalla.contrast);
            var comando = `{
                            "func": "setPictureProperty",
                            "options": {
                                "backlight": ${this.pantalla.backlight},
                                "blackLevel": "low",
                                "brightness": ${this.pantalla.brightness},
                                "color": 50,
                                "colorGamut": "extended",
                                "colorTemperature": 6500,
                                "contrast": ${this.pantalla.contrast},
                                "dynamicColor": "high",
                                "dynamicContrast": "low",
                                "gamma": "medium",
                                "mpegNoiseReduction": "low",
                                "noiseReduction": "medium",
                                "sharpness": 50,
                                "tint": 50,
                                }
                            }`;
            this.$inertia.socket.emit("mensaje", {uid: this.slug, message: comando,});
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
