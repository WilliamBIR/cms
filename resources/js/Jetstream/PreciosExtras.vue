<template>
    <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" style="max-width: 100px !important;" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">#</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Producto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Precio</th>
                </tr>
            </thead>
            <tbody id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in extra" :key="idx" :id="'tr'+idx" class="drag" draggable="true" :ondragstart="DragStart" :ondragenter="DragEnter" :ondragend="DragEnd" :ondragleave="DragLeave" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><p class="px-3 py-3 text-gray-500 relative bg-white rounded text-sm border-0 shadow-md outline-none text-center">{{idx}}</p></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'extra-producto-'+idx" type="text" v-model="n.name" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :id="'extra-precio-'+idx"   type="text" v-model="n.precio" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <input :name="'id-'+idx" type="hidden" v-model="n.id">
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        props:{
            extra: Object
        },
        data(){
            return{
                dragged:{
                    elem:null,
                    elem2:null
                }
            };
        },
        methods:{
            DragStart(evt){
                evt.dataTransfer.setData('text/plain',null);
                this.dragged.elem = evt.target;
                console.log('DragStart');
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
                    this.dragged.elem2.children[1].children[0].value = this.extra[id].name;
                    this.dragged.elem2.children[2].children[0].value = this.extra[id].precio;
                    this.dragged.elem.children[1].children[0].value = this.extra[id2].name;
                    this.dragged.elem.children[2].children[0].value = this.extra[id2].precio;
                    let pos = {name:this.extra[id].name,precio:this.extra[id].precio,centavo:this.extra[id].centavo};
                    this.extra[id].name = this.extra[id2].name;
                    this.extra[id].precio = this.extra[id2].precio;
                    this.extra[id2].name = pos.name;
                    this.extra[id2].precio = pos.precio;
                }
            }
        },
        mounted(){
            if(Array.isArray(this.extra))
                this.extra.length==0?this.extra.push({"name":"","precio":""}):'';
            else
                Object.values(this.extra).length == 0 ? this.extra[Object.values(this.extra).length] = {'name':'','precio':''} :'';
        }
    })
</script>