<template>
    <div class="m-0 p-3 flex" style="background: #f3f3f3;">
        <div class="md:w-1/2 xl:w-full pl-0 pr-1">
            <div class="bg-white rounded-sm overflow-hidden relative" style="height:254px;">
                <div>
                    <div style="text-align: center; display: table-cell; vertical-align: middle; width: 100%; height: 100%;">
                        <div align="center">
                            <img id="currentImage" style="height:254px;width: 100%;z-index: 100;vertical-align: middle;border: 0;" :src="captura">
                        </div>
                        <div id="blackScr" style="background-color: black; width: 100%; height: 254px; color: white;">
                            <div align="center">Apagado de pantalla</div>
                        </div>
                        <div class="screenshot-message rtl_language" id="screenshotStatus" style="text-align: left"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="refresh" style="float: right">
                        <button class="btn-refresh screenshot" @click="screenShot()"></button>
                    </div>
                    <div class="button" style="float: left; padding-left: 5px"  @click="screenTime">
                        <input id="captureRefresh" type="checkbox" class="custom">
                        <label for="captureRefresh">&nbsp;</label>
                    </div>
                    <div class="text txt_rolling" style="float: none; padding-left: 5px">
                        <span style="overflow: hidden;">Refrescar automáticamente 10 seg</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 xl:w-full pl-0 pr-1">
            <div class="card big green summary-inline" id="tempCard" style="height:254px;">
                <div class="card-header" style="overflow-y: hidden;">
                    <div class="card-title txt_rolling">
                        <span>Temperatura</span>
                    </div>
                    <div class="linkarrow">

                    </div>
                </div>
                <div class="card-body">
                    <div class="content" style="text-align: center; display: table-cell; vertical-align: middle; width: 328px; height: 191px;">
                        <div class="status">
                                <div class="temperature" style="width: 100%;">
                                    <span id="mainTemp">{{this.sensors.temperature}}</span>
                                </div>
                        </div>
                        <div class="status">
                                <div class="sensorname" style="width: 100%;">Principal</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="refresh" style="float: right">
                        <button class="btn-refresh screenshot" @click="sensor()"></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import JetButton from '@/Jetstream/Button.vue';

    export default defineComponent({
        components:{
           JetButton,
        },
        props:['view', 'slug'],
        data(){
            return{ 
                capturaContinua: false,
                captura: '/images/screenshot_noimage.png',
                sensors: {
                    backlight:0,
                    humidity: 0,
                    illuminance:0,
                    rotation: null,
                    temperature: 0 
                },
                senial: null,
                version: 0,
                nameSignage: 0,
                establecerId: null,
                dpm: "apagado",
                playUrl: null,
                red: null,
                time:null,
                wifi:null

            }
        }, 
        beforeMount(){
            this.sensor();  
        },
        mounted(){
            this.$inertia.socket.on("successIPK", function (payload) {
                console.log(payload);
                if (payload.error) {
                    console.log(`Error en slugIPK: ${payload.uid}, error: ${JSON.stringify(payload.error.errorText)}`);
                } else {
                    console.log(`Exito en slugIPK: ${payload.uid}`);
                    this.captura = payload.request.function == "captureScreen" ? 'data:image/jpg;base64,'+payload.message.data : this.captura;
                    this.sensors = payload.request.function == "getSensorValues" ? payload.message : this.sensors;
                }
            }.bind((this)));
        },
        methods:{
            screenShot(args){
                console.log('screenShot');
                var comando = `{
                    "func": "captureScreen",
                    "options": {
                    save : true,
                    thumbnail : false,
                    imgResolution : Signage.ImgResolution.FHD
                    }
                }`;
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: comando});

            },
            screenTime(evt){
                if(evt.target.localName == "input"){
                    evt.target.checked?(this.screenShot(),this.time = setInterval(()=>{this.screenShot();},10000)):clearInterval(this.time)
                }
            },
            sensor(){
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: `{"func": "getSensorValues"}`});
            },
            dataExtSingnal(){
                let comando =  `{
                    "func": "getExternalInputList",
                    "options": {
                    subscribe : false
                    }
                }`;
                this.$inertia.socket.emit("mensaje", { uid: this.slug, message: comando});
            },
        }
    })
</script>
