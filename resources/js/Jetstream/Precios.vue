<template>
    <div class="row">
        <div class="py-1 sm:px-20 bg-white border-b border-gray-200 w-full">
            <div class="text-lg flex justify-between">
                <div>
                    <jet-nav-link  v-for="(value,id) in precios"   @click.prevent="change(id)" :active="view==id ?true:false" class="mx-2 select-none" :key="id">
                        {{id}}
                    </jet-nav-link>
                </div>
            </div>
        </div>
        <div class="min-w-full">
            <div v-if="view=='Especial' && precios.Especial" class="tab-pane text-left fade show active" id="vert-tabs-especial" role="tabpanel" aria-labelledby="vert-tabs-especial-tab">
                <precio-especial-component :especial="precios.Especial" :especial2="especial2"></precio-especial-component>
            </div>
            <div v-if="view=='Normales' && precios.Normales" class="w-full" id="vert-tabs-normal" role="tabpanel" aria-labelledby="vert-tabs-normal-tab">
                <precio-normal-component :area="area" :normal="precios.Normales" :button="false" :modelo="modelo" :det="det"></precio-normal-component>
            </div>
            <div v-if="view=='Extra' && precios.Extra" class="tab-pane fade" id="vert-tabs-extra" role="tabpanel" aria-labelledby="vert-tabs-extra-tab">
                <precio-extra-component :extra="precios.Extra"></precio-extra-component>
            </div>
        </div>
        <div class="w-full flex justify-center my-4">
            <a @click="pborrar" v-if="view != 'Especial'" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4" style="color:white">-</a>
            <form @submit.prevent="submit" class="z-index-1">
                <button type="submit"  class="inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-400 active:bg-sky-700 focus:outline-none focus:border-sky-800 focus:ring focus:ring-sky-300 disabled:opacity-25 transition ml-4">Guardar</button>
            </form>
            <a @click="pagregar" v-if="view != 'Especial'" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4" style="color:white">+</a>
        </div>
    </div>
</template>
<script>
import { defineComponent } from 'vue';
import  PrecioEspecialComponent from '@/Jetstream/PreciosEspeciales.vue';
import  PrecioNormalComponent from '@/Jetstream/PreciosNormales.vue';
import  PrecioExtraComponent from '@/Jetstream/PreciosExtras.vue';
import JetNavLink from '@/Jetstream/NavBtnLink.vue';
    
    export default defineComponent({
        components:{
            PrecioEspecialComponent,
            PrecioNormalComponent,
            PrecioExtraComponent,
            JetNavLink
        },
        props:['precios','area','modelo','det','especial2'],
        data(){
            return{
                arrayPrice: {
                    area: this.area,
                    modelo: this.modelo,
                    det: this.det,
                    precios: {}               
                },
                div : document.createElement('div'),
                view:Object.keys(this.precios)[0]
            };
        },
        methods:{
            submit(){
                let alert = true;
                if(this.precios.Especial){
                    this.precios.Especial.forEach(esp => {
                        esp.name == ''?alert=false:'';
                        esp.price == ''?alert=false:'';
                        esp.pennies == ''?alert=false:'';
                    });
                }
                if(alert){
                    this.arrayPrice.precios.especial = this.precios.Especial;
                    this.precios.Normales?this.arrayPrice.precios.normales = this.precios.Normales:'';
                    this.precios.Extra?this.arrayPrice.precios.extras = this.precios.Extra:'';
                    this.$inertia.visit('/modelo/savePrice',{
                        method:'post',
                        data:this.arrayPrice,
                        onFinish: () => {
                            document.getElementsByTagName('body')[0].removeChild(document.getElementById('modalBackdrop'));
                        }
                    });
                    document.getElementsByTagName('body')[0].appendChild(this.div);
                }else{
                    this.$page.props.flash.error = {'especial':'Agregue correctamente los precios Especiales'};
                    console.log('No puede quedar vacio los precios especiales');
                }
            },
            pagregar(){
                switch(this.view){
                    case "Normales":
                        this.precios.Normales[Object.values(this.precios.Normales).length] = {'det':'','id':'','modelo_id':this.precios.Normales[0].modelo_id,'name':'','nombre':'','precio':'','centavo':''};
                        break
                    case "Extra":
                        this.precios.Extra[Object.values(this.precios.Extra).length] = {'det':'','id':'','modelo_id':this.precios.Extra[0].modelo_id,'name':'','nombre':'','precio':'','centavo':''};
                        break
                }
            },
            pborrar(){
                switch(this.view){
                    case "Normales":
                        if(Array.isArray(this.precios.Normales))
                            this.precios.Normales.length>1?this.precios.Normales.splice(this.precios.Normales.length-1,1):'';
                        else
                            Object.values(this.precios.Normales).length>1?(delete this.precios.Normales[Object.values(this.precios.Normales).length-1]):'';
                        break
                    case "Extra":
                        if(Array.isArray(this.precios.Extra))
                            this.precios.Extra.length>1?this.precios.Extra.splice(this.precios.Extra.length-1,1):'';
                        else
                            Object.values(this.precios.Extra).length>1?(delete this.precios.Extra[Object.values(this.precios.Extra).length-1]):'';
                        break
                }
            },
            change(id){
                this.view = id;
            }
        },
        mounted(){
            this.arrayPrice.area = this.area;
            this.arrayPrice.modelo = this.modelo;
            this.arrayPrice.det = this.det;
            this.div.setAttribute('class','carga');
            this.div.setAttribute('id','modalBackdrop');
        }
    })
</script>
