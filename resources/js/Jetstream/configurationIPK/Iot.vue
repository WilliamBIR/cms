<template>
    <div>
            <h3>Iot</h3>
    </div>
     <div>
                <h4 style="text-align:center; font-size:30px"> Binding Id List </h4>
                <a @click.prevent="getBindingIdList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getBindingIdList</a>         
    </div>

    <div>
            <h4 style="text-align:center; font-size:30px"> Binding Id List </h4>
            <input type="text" name="bridgeUid" v-model="bridgeUid">
            <a @click.prevent="getBridgeStatus" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getBindingIdList</a>         
            <a @click.prevent="requestSetBridgeStatus" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestSetBridgeStatus</a>         
    
    </div>
    <div>
                <h4 style="text-align:center; font-size:30px"> Framework Status </h4>
                <a @click.prevent="getFrameworkStatus" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getFrameworkStatus</a>         
    </div>

    <div>
                <h4 style="text-align:center; font-size:30px"> Thing List </h4>
                <a @click.prevent="getThingList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getThingList</a>         
                <a @click.prevent="getThingListPrivate" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getThingListPrivate</a>         
                <a @click.prevent="requestSetComponent" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestSetComponent</a>         
                <a @click.prevent="requestUnregisterThing" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestUnregisterThing</a>         
                <a @click.prevent="setThingNickname" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">setThingNickname</a>         
    
     
    </div>
    <div>
                <h4 style="text-align:center; font-size:30px">Versions</h4>
                <a @click.prevent="getVersions" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getVersions</a>         
    
    </div>

    <div>
                <h4 style="text-align:center; font-size:30px">Factory Reset</h4>
                <a @click.prevent="requestFactoryReset" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestFactoryReset</a>         
    
    </div>
    <div>
                <h4 style="text-align:center; font-size:30px">Things</h4>
                <a @click.prevent="requestRegisterThing" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestRegisterThing</a>         
                <a @click.prevent="requestRejectThing" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestRejectThing</a>         
    
    </div> 
    <div>
                <h4 style="text-align:center; font-size:30px">Sincronizar cosas?</h4>
                <a @click.prevent="requestSynchronizeThing" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">requestSynchronizeThing</a>         
                <a @click.prevent="subscribeIoTEvent" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">subscribeIoTEvent</a>         
    
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
            bindingIdList:{},
            bridgeUid:"",
            frameworkStatus:{},
            thingList:{},
            thingListPrivate:{},
            versions:{}
            }
        },
        beforeMount(){
            console.log('montando Iot')        },
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
                    if(payload.request.function == "getBindingIdList"){ this.bindingIdList=payload.message;console.log(this.bindingIdList)};
                    if(payload.request.function == "getFrameworkStatus"){ this.frameworkStatus=payload.message;console.log(this.frameworkStatus)};
                    if(payload.request.function == "getThingList"){ this.thingList=payload.message;console.log(this.thingList)};
                    if(payload.request.function == "getThingListPrivate"){ this.thingListPrivate=payload.message;console.log(this.thingListPrivate)};
                    if(payload.request.function == "getVersions"){ this.versions=payload.message;console.log(this.versions)};
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            getBindingIdList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func":"getBindingIdList"}`})
            },
            getBridgeStatus(){
                /**
                 * Scan o normal
                 */
                var comando=`{
                    "func":"getBridgeStatus",
                    "options":{
                        bridgeUid:"${this.bridgeUid}"
                    }
                }`
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            getFrameworkStatus(){
                /**
                 * off -> apagado
                 * initializing -> Inicializando
                 * ready -> Listo
                 */
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getFrameworkStatus"}`})
            },
            getThingList(){
                var comando=`{
                    "func":"getThingList",
                    "options":{
                            thingUidList : ["Zigbee:ZHA"],
                            thingType : "ThingBridge"
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            getThingListPrivate(){
                var comando=`{
                    "func":"getThingListPrivate",
                    "options":{
                            thingUidList : ["Zigbee:ZHA"],
                            thingType : "ThingBridge"
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            getVersions(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getVersions"}`})
            },
            requestFactoryReset(){
                console.log("reseteando de fabrica")
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message:`{"func": "requestFactoryReset"}`})
            },
            requestRegisterThing(){
                var comando=`{
                    "func":"requestRegisterThing",
                    "options":{
                        thingUid:"Zigbee: 132lASDDA"
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            requestRejectThing(){
                var comando=`{
                    "func":"requestRejectThing",
                    "options":{
                        thingUid:"Zigbee: 132lASDDA!
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            requestSetBridgeStatus(){
                //scan o normal
                var comando=`{
                    "func":"requestRejectThing",
                    "options":{
                        bridgeUid : "Zigbee:ZHA",
                        status : "scan"
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            requestSetComponent(){
                var comando=`{
                    "func":"requestRejectThing",
                    "options":{
                        thingUid:"",
                        componentId:"",
                        componentValue:{},
                        callId:"",
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },

            /**The component ID to be synchronized. If it is not defined, all components of the thing will request to be synchronized. */
            requestSynchronizeThing(){
                var comando=`{
                    "func":"requestSynchronizeThing",
                    "options":{
                        thingUid:"",
                        componentId:""
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            requestUnregisterThing(){
                var comando=`{
                    "func":"requestUnregisterThing",
                    "options":{
                        thingUid:"",
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            setThingNickname(){
                var comando=`{
                    "func":"setThingNickname",
                    "options":{
                        thingUid:"",
                        nickname:"",
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            },
            subscribeIoTEvent(){
                var comando=`{
                    "func":"subscribeIoTEvent",
                    "options":{
                        subscribe:true,
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: comando})
            }
        }
    })
</script>
