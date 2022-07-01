<template>
    <div>
            <h3>Input Source</h3>
    </div>
    <!--div>
                <h4 style="text-align:center; font-size:30px"> Externa Input List </h4>
                <a @click.prevent="getExternalInputList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">getExternalInputList</a>         
    </div -->
    <div>
        <h4 style="text-align:center; font-size:30px"> Input Source Status</h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actual</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Lista</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getInputSourceStatus" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <input type="text" disabled v-model="inputSourceStatus.currentInputSource">
                    </td>
                    <td style="text-align:center">
                        <select v-model="input">
                            <option value="none">None </option>
                            <option v-for="value in inputSourceStatus.inputSourceList" value=value.inputPort :key=value >{{value.inputPort}} </option>
                        </select>  
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="changeInputSource" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
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
                externalInputList:{
                    inputSourceList:[],
                    subscribed:null,
                    count:0,
                    currentInoutPort:"",
                },
                inputSourceStatus:{
                    inputSourceList:[],
                    currentSignalState:"",
                    currentInputSource:"",
                },
                input:"",
            }
        },
        beforeMount(){
            console.log('montando INput Source')        },
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
                    if(payload.request.function == "getExternalInputList"){ this.externalInputList=payload.message;console.log(this.externalInputList)};
                    if(payload.request.function == "getInputSourceStatus"){ this.inputSourceStatus=payload.message;console.log(this.inputSourceStatus)};
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            getExternalInputList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{ "func": "getExternalInputList"}`})
            },
            /**La salida de currentSignalState puede dar:
             * -good Good signal
             * -bad Poor signal
             * -unknown No signal status available
             */
            getInputSourceStatus(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{ "func":"getInputSourceStatus"}`})
            },
            /** El src es la entrada, por ejemplo
             * ext://hdmi:1
             * ext://hdmi:2
             * ext://dp:1
             * ext://ops:1
             */
            changeInputSource(){
                var comando=`{
                    "func":"changeInputSource",
                    "options":{
                        src:"${this.input}"
                    }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: comando})
                setTimeout(()=>{this.getExternalInputList()},500);
            },
            initialize(){
                var comando=`{
                    "func":"initialize",
                    "options":{
                        divId:"",
                        videoId:"",
                        callback:"",
                        src:"",
                        noaudio:true,
                    }
                }`
            },
        }
    })
</script>
