<template>
   <div class="flex flex-wrap justify-center items-center pt-3 overflow-auto max-h-100">
        <table id="lista_precios" class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">#</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Producto</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Precio</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" rowspan="1" colspan="1">Centavos</th>
                </tr> 
            </thead>
            <tbody id="list" class="bg-white divide-y divide-gray-200">
                <tr v-for="(n, idx) in especial" :key="idx" :id="'tr'+idx" class="drag" draggable="true" ondragstart="event.dataTransfer.setData('text/plain',null)" role="row">
                    <td class="px-2 py-2 whitespace-nowrap"><p class="px-3 py-3 text-gray-500 relative bg-white rounded text-sm border-0 shadow-md outline-none text-center">{{idx}}</p></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :name="'especial-producto-'+idx" type="text" v-model="n.name" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :name="'especial-precio-'+idx"   type="text" v-model="n.price" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                    <td class="px-2 py-2 whitespace-nowrap"><input :name="'especial-centavo-'+idx"  type="text" v-model="n.pennies" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow-md outline-none focus:outline-none focus:ring w-full text-center"></td>
                </tr>
            </tbody> 
        </table>
    </div>
</template>
<script>
    import { defineComponent } from 'vue';
    export default defineComponent({
        props:['especial','especial2'],
        mounted(){
            for(let i=0;i<this.especial2;i++){
                if(Array.isArray(this.especial))
                    this.especial.length < this.especial2?this.especial.push({"name":"","price":"","pennies":""}):'';
                else
                    Object.values(this.especial).length < this.especial2 ? this.especial[Object.values(this.especial).length] = {'name':'','price':'','pennies':''} :'';
            }
        }
    })
</script>