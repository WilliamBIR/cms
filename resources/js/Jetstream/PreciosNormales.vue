<template>
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">#</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Producto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">{{tPrecio}}</th>
                    <th v-if="centavo" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">{{tCentavos}}</th>
                </tr>
            </thead>
            <tbody id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in normal" :key="idx" :id="'tr'+idx" class="drag" draggable="true" :ondragstart="DragStart" :ondragenter="DragEnter" :ondragend="DragEnd" :ondragleave="DragLeave" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><p class="px-3 py-3 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none text-center">{{idx}}</p></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-producto-'+idx" v-model="n.name" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'normal-precio-'+idx" v-model="n.precio" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td v-if="centavo" class="px-2 py-2 whitespace-nowrap">
                        <select v-if="deli" v-model="n.centavo" :id="'normal-centavo-'+idx" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">
                            <option selected disabled>Selecciona una opcion</option>
                            <option value="Deli" :selected="n.centavo=='Deli'?'selected':''">Alimentos Preparados</option>
                            <option value="sandwich" :selected="n.centavo=='sandwich'?'selected':''">Sándwiches</option>
                            <option value="ensalada" :selected="n.centavo=='ensalada'?'selected':''">Ensalada y salsa a granel</option>
                            <option value="salsas" :selected="n.centavo=='salsas'?'selected':''">Salsas empacadas</option>
                            <option value="paquetes" :selected="n.centavo=='paquetes'?'selected':''">Paquetes</option>
                        </select>
                        <input v-else :id="'normal-centavo-'+idx" v-model="n.centavo" type="text" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center">
                    </td>
                    <input :name="'id-'+idx" type="hidden" :value="n.id">
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="button" class="w-full flex justify-center my-4">
        <a @click="borrar" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">-</a>
        <form @submit.prevent="submit">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Guardar</button>
        </form>
        <a @click="agregar" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">+</a>
    </div>
</template>
<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        props:['normal','button','area','modelo','det'],
        data(){
            return{
                div : document.createElement('div'),
                centavo:true,
                deli:false,
                tPrecio: 'Precio',
                tCentavos: 'Centavos',
                dragged:{
                    elem:null,
                    elem2:null
                },
                arrayNormal: {
                    area: this.area,
                    modelo: this.modelo,
                    det: this.det,
                    precios: {}               
                },
            };
        },
        methods:{
            submit(){
                this.arrayNormal.precios.normales = this.normal;
                this.$inertia.visit('/modelo/savePrice',
                {
                    method:'post',
                    data:this.arrayNormal,
                    onFinish: () => {
                        document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop'));
                    }
                });
                document.getElementsByTagName('body')[0].appendChild(this.div);
            },
            agregar(){
                if(Array.isArray(this.normal))
                    this.normal.push({"name":"","precio":"","centavo":""});
                else
                    this.normal[Object.values(this.normal).length] = {'det':'','id':'','modelo_id':this.normal[0].modelo_id,'name':'','nombre':'','precio':'','centavo':''};
            },
            borrar(){
                if(Array.isArray(this.normal))
                    this.normal.length>1?this.normal.splice(this.normal.length-1,1):'';
                else
                    Object.values(this.normal).length>1?(delete this.normal[Object.values(this.normal).length-1]):'';
            },
            DragStart(evt){
                evt.dataTransfer.setData('text/plain',null);
                this.dragged.elem = evt.target;
            },
            DragEnter(evt){
                if(evt.target.parentNode != this.dragged.elem && evt.target.localName == 'p'){
                    this.dragged.elem2 = evt.target.parentNode.parentNode;
                    this.dragged.elem2.classList.add('bg-blue-200');
                }
            },
            DragLeave(evt){
                if(evt.target.parentNode.parentNode == this.dragged.elem2 && evt.target.localName == 'p'){
                    this.dragged.elem2.classList.remove('bg-blue-200');
                }
            },
            DragEnd(evt){
                if(this.dragged.elem != this.dragged.elem2){
                    let id = this.dragged.elem.id.split('r')[1];
                    let id2 = this.dragged.elem2.id.split('r')[1];
                    this.dragged.elem2.children[1].children[0].value = this.normal[id].name;
                    this.dragged.elem2.children[2].children[0].value = this.normal[id].precio;
                    this.dragged.elem2.children[3].children[0].value = this.normal[id].centavo;
                    this.dragged.elem.children[1].children[0].value = this.normal[id2].name;
                    this.dragged.elem.children[2].children[0].value = this.normal[id2].precio;
                    this.dragged.elem.children[3].children[0].value = this.normal[id2].centavo;
                    let pos = {name:this.normal[id].name,precio:this.normal[id].precio,centavo:this.normal[id].centavo};
                    this.normal[id].name = this.normal[id2].name;
                    this.normal[id].precio = this.normal[id2].precio;
                    this.normal[id].centavo = this.normal[id2].centavo;
                    this.normal[id2].name = pos.name;
                    this.normal[id2].precio = pos.precio;
                    this.normal[id2].centavo = pos.centavo;
                }
            }
        },
        mounted(){
            this.area=='Perecederos'||this.modelo=='Bebidas Calientes 2'?this.centavo=true:this.centavo=false
            this.modelo=='Bebidas Calientes 2'?(this.tCentavos='Grande (16 oz)',this.tPrecio='Chico (8 oz)'):''
            this.modelo=='Deli U'?this.deli=true:this.deli=false
            if(Array.isArray(this.normal))
                this.normal.length==0?this.normal.push({"name":"","precio":"","centavo":""}):'';
            else
                Object.values(this.normal).length == 0 ? this.normal[Object.values(this.normal).length] = {'det':'','id':'','modelo_id':this.normal[0].modelo_id,'name':'','nombre':'','precio':'','centavo':''} :'';
            this.div.setAttribute('class','carga');
            this.div.setAttribute('id','modalBackdrop');
        }
    })
</script> 