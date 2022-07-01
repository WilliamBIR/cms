<template>
    <div>
            <h3>Security</h3>
    </div>

     <div>
        <h4 style="text-align:center; font-size:30px"> Keys items </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Resetear</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tecla</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="clearKeyTable" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Resetear</a>         
                    </td>
                    <td style="text-align:center">
                         <select v-model="virtualKeyCode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Signage.KeyCode.AUTO>Auto </option>
                            <option value=Signage.KeyCode.BACK>Back </option>
                            <option value=Signage.KeyCode.BLUE>Blue </option>
                            <option value=Signage.KeyCode.BRIGHTNESS_DOWN>Brightness down  </option>
                            <option value=Signage.KeyCode.BRIGHTNESS_UP>Brightness up </option>
                            <option value=Signage.KeyCode.CLEAR>Clear </option>
                            <option value=Signage.KeyCode.DISC_POWER_OFF>Discrete power off </option>
                            <option value=Signage.KeyCode.DISC_POWER_ON>Discrete Power on </option>
                            <option value=Signage.KeyCode.ENERGY_SAVING>Energy saving </option>
                            <option value=Signage.KeyCode.ENTER>Enter </option>
                            <option value=Signage.KeyCode.EXIT>Exit </option>
                            <option value=Signage.KeyCode.FAST_FORWARD>Fast Forward </option>
                            <option value=Signage.KeyCode.GREEN>Green </option>
                            <option value=Signage.KeyCode.INFO>Info </option>
                            <option value=Signage.KeyCode.INPUT>input </option>
                            <option value=Signage.KeyCode.LEFT>left </option>
                            <option value=Signage.KeyCode.LG_3D>lg 3d </option>
                            <option value=Signage.KeyCode.MENU>Menu </option>
                            <option value=Signage.KeyCode.MUTE>MUTE </option>
                            <option value=Signage.KeyCode.NUM_0>NUM_0 </option>
                            <option value=Signage.KeyCode.NUM_1>NUM_1 </option>
                            <option value=Signage.KeyCode.NUM_2>NUM_2 </option>
                            <option value=Signage.KeyCode.NUM_3>NUM_3 </option>
                            <option value=Signage.KeyCode.NUM_4>NUM_4 </option>
                            <option value=Signage.KeyCode.NUM_5>NUM_5 </option>
                            <option value=Signage.KeyCode.NUM_6>NUM_6 </option>
                            <option value=Signage.KeyCode.NUM_7>NUM_7 </option>
                            <option value=Signage.KeyCode.NUM_8>NUM_8 </option>
                            <option value=Signage.KeyCode.NUM_9>NUM_9 </option>
                            <option value=Signage.KeyCode.OPT_1aA>OPT_1aA </option>
                            <option value=Signage.KeyCode.PAUSE>PAUSE </option>
                            <option value=Signage.KeyCode.PLAY>PLAY </option>
                            <option value=Signage.KeyCode.POWER>POWER </option>
                            <option value=Signage.KeyCode.PSM>PSM </option>
                            <option value=Signage.KeyCode.RATIO>RATIO </option>
                            <option value=Signage.KeyCode.RED>RED </option>
                            <option value=Signage.KeyCode.REWIND>REWIND </option>
                            <option value=Signage.KeyCode.RIGHT>RIGHT </option>
                            <option value=Signage.KeyCode.SIMPLINK>SIMPLINK </option>
                            <option value=Signage.KeyCode.SMART_HOME>SMART_HOME </option>
                            <option value=Signage.KeyCode.SMENU>SMENU </option>
                            <option value=Signage.KeyCode.STOP>STOP </option>
                            <option value=Signage.KeyCode.TILE>TILE </option>
                            <option value=Signage.KeyCode.UP>UP </option>
                            <option value=Signage.KeyCode.VOL_DOWN>VOL_DOWN </option>
                            <option value=Signage.KeyCode.VOL_UP>VOL_UP </option>
                            <option value=Signage.KeyCode.WBAL>WBAL </option>
                            <option value=Signage.KeyCode.YELLOW>YELLOW </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="sendKey" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Check Screen </h4>  
                <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Opcion</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center">
                        <select v-model="checkScreen">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>Activar </option>
                            <option value=false>Desactivar </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="enableCheckScreen" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> FailOver Mode </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getFailoverMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                         <select v-model="failoverMode.mode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Signage.FailoverMode.AUTO>Auto </option>
                            <option value=Signage.FailoverMode.MANUAL>Manual </option>
                            <option value=Signage.FailoverMode.OFF>Off </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setFailoverMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Intelligent Auto </h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getIntelligentAuto" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="intelligentAuto">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>Encendido </option>
                            <option value=false>Apagado </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setIntelligentAuto" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Mirror Mode </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getMirrorMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="mirrorMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=on>Encendido </option>
                            <option value=off>Apagado </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setMirrorMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> Lan Daisy chain </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getLanDaisyChain" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="lanDaisyChain">
                            <option disabled value=null>Seleccione un elemento</option>
                            <option value=true>Encendido </option>
                            <option value=false>Apagado </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setLanDaisyChain" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> Signal Image Mode</h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Resetear</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getNoSignalImageMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center"><a @click.prevent="resetNoSignalImage" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Resetear</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="noSignalImage.enabled">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=on>Encendido </option>
                            <option value=off>Apagado </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setNoSignalImageMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Power Save Mode</h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ses</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">dpmMode</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">automaticStandby</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">do15MinOff</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                    
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center">
                        <a @click.prevent="getPowerSaveMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
        
                    </td>
                    <td style="text-align:center">
                            <select v-model="powerSaveMode.ses">
                                <option disabled value="">Seleccione un elemento</option>
                                <option value=true>Encendido </option>
                                <option value=false>Apagado </option>
                            </select>    
                    </td>
                    <td style="text-align:center">
                        <select v-model="powerSaveMode.dpmMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=OFF>off </option>
                            <option value=POWER_OFF_5SECOND>5sec </option>
                            <option value=POWER_OFF_10SECOND>10 sec </option>
                            <option value=POWER_OFF_15SECOND>15 sec </option>
                            <option value=POWER_OFF_1MINUTE>1 min </option>
                            <option value=POWER_OFF_3MINUTE>3 min  </option>
                            <option value=POWER_OFF_5MINUTE>5 min </option>
                            <option value=POWER_OFF_10MINUTE>10 min </option>
                        </select>
                    </td>
                    <td style="text-align:center">
                        <select v-model="powerSaveMode.automaticStandby">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=OFF>off </option>
                            <option value=STANDBY_4HOURS>4 horas </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <select v-model="powerSaveMode.do15MinOff">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=true>Encendido </option>
                            <option value=false>Apagado </option>
                        </select>
                    </td> 


                    <td style="text-align:center">
                        <a @click.prevent="setPowerSaveMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>



    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Quite Mode</h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getQuietMode" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="quietMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=on>on </option>
                            <option value=off>off </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setQuietMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> RS232 Configuration</h4>
        <a @click.prevent="getRS232CConfiguration" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Obtener</a>          
        <a @click.prevent="sendRS232CData" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Send Data</a>          
        <a @click.prevent="setRS232CConfiguration" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Ejecutar</a>          

        </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Signage Info</h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ISM Method</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">portraitMode</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getSignageInfo" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="signageInfo.ismMethod">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=COLORWASH>COLORWASH </option>
                            <option value=INVERSION>INVERSION </option>
                            <option value=NORMAL>NORMAL </option>
                            <option value=ORBITER>ORBITER </option>
                            <option value=USER_IMAGE>USERIMAGE </option>
                            <option value=USER_VIDEO>USERVIDEO </option>
                            <option value=WASHING_BAR>WASHINGBAR </option>
                            <option value=WHITEWASH>WHITEWASH </option>
                        </select>
                        <a @click.prevent="setIsmMethod" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Ejecutar</a>          
        
                    </td> 
                    <td style="text-align:center">
                        <select v-model="signageInfo.portraitMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=ON>90 </option>
                            <option value=OFF>0 </option>
                        </select>
                        <a @click.prevent="setPortraitMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Ejecutar</a>          
                    </td> 
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Simplink </h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getSimplinkStatus" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="simplinkStatus">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=on>on </option>
                            <option value=off>off </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setSimplinkStatus" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> System Monitoring Info </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fan</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Lamp</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">screen</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Signal</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">temperature</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getSystemMonitoringInfo" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <input type="text" disabled v-model="systemMonitoringInfo.fan">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled v-model="systemMonitoringInfo.lamp">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled v-model="systemMonitoringInfo.screen">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled v-model="systemMonitoringInfo.signal">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled v-model="systemMonitoringInfo.temperature">
                    </td> 

                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Usage Data </h4>


        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">uptime</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">TotalUsed</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getUsageData" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <input type="text" disabled v-model="usageData.uptime">
                    </td> 
                    <td style="text-align:center">
                        <input type="text" disabled v-model="usageData.totalUsed">
                    </td> 
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> Usage Permissions </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Obtener</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Remote</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Local</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center"><a @click.prevent="getUsagePermission" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white  artext-white uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-600 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>         
                    </td>
                    <td style="text-align:center">
                        <select v-model="usagePermission.remoteKeyOperationMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=ALLOW_ALL>normal </option>
                            <option value=BLOCK_ALL>block all </option>
                            <option value=POWER_ONLY>use ower Only </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <select v-model="usagePermission.localKeyOperationMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=ALLOW_ALL>normal </option>
                            <option value=BLOCK_ALL>block all </option>
                            <option value=POWER_ONLY>use ower Only </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setUsagePermission" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <h4 style="text-align:center; font-size:30px"> Digital Audio Input </h4>

        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Input</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center">
                        <select v-model="digitalAudioInput">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Signage.DigitalAudioInput.HDMI_DP>HDMI DP </option>
                            <option value=Signage.DigitalAudioInput.AUDIO_IN>AUDIO IN </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="setDigitalAudioInputMode" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div>
        <h4 style="text-align:center; font-size:30px"> Super Reset </h4>
        <table  class="min-w-full divide-y divide-gray-200" role="grid">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Input</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr  class="drag" role="row">
                    <td style="text-align:center">
                        <select v-model="resetMode">
                            <option disabled value="">Seleccione un elemento</option>
                            <option value=Signage.ResetMode.SOFT_RESET>Soft Reset </option>
                            <option value=Signage.ResetMode.FACTORY_RESET>Factory Reset </option>
                        </select>
                    </td> 
                    <td style="text-align:center">
                        <a @click.prevent="reset" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Cambiar</a>         
        
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
                checkScreen:false,
                failoverMode:{
                    mode:null,
                    priority:[]
                },
                intelligentAuto:false,
                mirrorMode:"",
                lanDaisyChain:null,
                noSignalImage:{enabled: false},
                powerSaveMode:{
                    ses:"",  //Smart Energy Saving Mode
                    dpmMode:"", //Dinamic Power Management
                    automaticStandby:"", //Automatic Standby Mode
                    do15MinOff:false, 
                },
                quietMode:"",
                rS232CConfiguration:{
                    mode:null,
                    port:null,
                    baudRate:null,
                    dataBit:null,
                    parity:null,
                    stopBit:null,
                    flowControl:null,
                    rxTimeoutInMs:null,
                },
                signageInfo:{
                    portraitMode:"",
                    digitalAudioInputMode:"",
                    ismMethod:"",
                    checkScreen:false,
                },
                simplinkStatus:null,
                systemMonitoringInfo:{
                    fan:null,
                    signal:null,
                    lamp:null,
                    screen:null,
                    temperatura:null,
                },
                usageData:{
                    uptime:null,
                    totalUsed:null,
                },
                usagePermission:{
                    remoteKeyOperationMode:"",
                    localKeyOperationMode:"",
                },
                resetMode:"",
                virtualKeyCode:"",
                digitalAudioInput:"",
            }
        },
        beforeMount(){
            console.log('montando Power')        },
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
                    if(payload.request.function == "getFailoverMode"){ 
                        this.failoverMode=payload.message;
                        if(payload.message.mode=="off"){
                            this.failoverMode.mode="Signage.FailoverMode.OFF"
                        }
                        if(payload.message.mode=="auto"){
                            this.failoverMode.mode="Signage.FailoverMode.AUTO"
                        }
                        if(payload.message.mode=="manual"){
                            this.failoverMode.mode="Signage.FailoverMode.MANUAL"
                        }
                        console.log(this.failoverMode)};  
                    if(payload.request.function == "getIntelligentAuto"){ this.intelligentAuto=payload.message.enabled;console.log(this.intelligentAuto)};  
                    if(payload.request.function == "getMirrorMode"){ this.mirrorMode=payload.message.mode;console.log(this.mirrorMode)};  
                    if(payload.request.function == "getLanDaisyChain"){ this.lanDaisyChain=payload.message.enabled;console.log(this.lanDaisyChain)};  
                    if(payload.request.function == "getNoSignalImageMode"){ this.noSignalImage=payload.message;console.log(this.noSignalImage)};  
                    if(payload.request.function == "getPowerSaveMode"){ 
                        this.powerSaveMode=payload.message;
                        console.log(this.powerSaveMode)
                        if(payload.message.dpmMode=="off"){
                            this.powerSaveMode.dpmMode="OFF"
                        }
                        if(payload.message.dpmMode=="5sec"){
                            this.powerSaveMode.dpmMode="POWER_OFF_5SECOND"
                        }
                        if(payload.message.dpmMode=="10sec"){
                            this.powerSaveMode.dpmMode="POWER_OFF_10SECOND"
                        }
                        if(payload.message.dpmMode=="15sec"){
                            this.powerSaveMode.dpmMode="POWER_OFF_15SECOND"
                        }
                        if(payload.message.dpmMode=="1min"){
                            this.powerSaveMode.dpmMode="POWER_OFF_1MINUTE"
                        }
                        if(payload.message.dpmMode=="3min"){
                            this.powerSaveMode.dpmMode="POWER_OFF_3MINUTE"
                        }
                        if(payload.message.dpmMode=="5min"){
                            this.powerSaveMode.dpmMode="POWER_OFF_5MINUTE"
                        }
                        if(payload.message.dpmMode=="10min"){
                            this.powerSaveMode.dpmMode="POWER_OFF_10MINUTE"
                        }
                        //Automatic Standby
                        if(payload.message.automaticStandby=="off"){
                            this.powerSaveMode.automaticStandby="OFF"
                        }
                        if(payload.message.automaticStandby=="4hours"){
                            this.powerSaveMode.automaticStandby="STANDBY_4HOURS"
                        }
                        };  
                    if(payload.request.function == "getQuietMode"){ this.quietMode=payload.message.mode;console.log(this.quietMode)};  
                    if(payload.request.function == "getRS232CConfiguration"){ this.rS232CConfiguration=payload.message;console.log(this.rS232CConfiguration)};  
                    if(payload.request.function == "getSignageInfo"){ 
                        this.signageInfo=payload.message;
                        if(payload.message.portraitMode=="off"){
                            this.signageInfo.portraitMode="OFF"
                        }
                        if(payload.message.portraitMode=="on" || payload.message.portraitMode=="90"){
                            this.signageInfo.portraitMode="ON"
                        }
                        
                        console.log(this.signageInfo)};  
                    if(payload.request.function == "getSimplinkStatus"){ this.simplinkStatus=payload.message.simplinkEnable;console.log(this.simplinkStatus)};  
                    if(payload.request.function == "getSystemMonitoringInfo"){ this.systemMonitoringInfo=payload.message;console.log(this.systemMonitoringInfo)};  
                    if(payload.request.function == "getUsageData"){ this.usageData=payload.message;console.log(this.usageData)};  
                    if(payload.request.function == "getUsagePermission"){ 
                        //this.usagePermission=payload.message;
                        if(payload.message.remoteKeyOperationMode=="normal"){
                            this.usagePermission.remoteKeyOperationMode="ALLOW_ALL"
                        }
                        if(payload.message.remoteKeyOperationMode=="blockAll"){
                            this.usagePermission.remoteKeyOperationMode="BLOCK_ALL"
                        }
                        if(payload.message.remoteKeyOperationMode=="usePwrOnly"){
                            this.usagePermission.remoteKeyOperationMode="POWER_ONLY"
                        }
                        if(payload.message.localKeyOperationMode=="normal"){
                            this.usagePermission.localKeyOperationMode="ALLOW_ALL"
                        }
                        if(payload.message.localKeyOperationMode=="blockAll"){
                            this.usagePermission.localKeyOperationMode="BLOCK_ALL"
                        }
                        if(payload.message.localKeyOperationMode=="usePwrOnly"){
                            this.usagePermission.localKeyOperationMode="POWER_ONLY"
                        }
                        console.log(this.usagePermission)
                        }  
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            addKeyItem(){
                var comando=`{
                    "func": "addKeyItem",
                    "options":{
                        keyCode : 0x12345678,
                        virtualKeyCode : Signage.KeyCode.EXIT,
                        attribute : 2
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: comando})
            },
            clearKeyTable(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "clearKeyTable"}`})
            },
            enableCheckScreen(){
                var comando=`{
                    "func": "enableCheckScreen",
                    "options":{
                        checkScreen:${this.checkScreen}
                    }
                }`;
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: comando})
            },
            getFailoverMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getFailoverMode" }`})
            },
            getIntelligentAuto(){
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message:`{"func": "getIntelligentAuto"}`})
            },
            getMirrorMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getMirrorMode" }`})
            },
            getLanDaisyChain(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getLanDaisyChain"}`})
            },
            getNoSignalImageMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getNoSignalImageMode" }`})
            },
            getPowerSaveMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getPowerSaveMode" }`})
            },
            getQuietMode(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getQuietMode" }`})
            },
            getRS232CConfiguration(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getRS232CConfiguration" }`})
            },
            getSignageInfo(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: `{"func": "getSignageInfo" }`})
            },
            getSimplinkStatus(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: `{"func": "getSimplinkStatus" }`})
            },
            getSystemMonitoringInfo(){
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: `{"func": "getSystemMonitoringInfo" }`})
            },
            getUsageData(){
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: `{"func": "getUsageData" }`})
            },
            getUsagePermission(){
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message: `{"func" :"getUsagePermission" }`})
            },

            /**Preguntar sobre:
            * registerRS232CEventListener
            * registerSystemMonitor
            * unregisterSystemMonitor
            * updateNoSignalImageList
            * unregisterRS232CEventListener
            **/

           removeKeyItem(){
               var comando=`{
                   "func": "removeKeyItem",
                   "options":{
                       keyCode:0x12345678
                   }
               }`
               this.$inertia.socket.emit("mensaje",{uid: this.slug, message:comando})
           },
           reset(){
               var comando=`{
                   "func": "reset",
                   "options":{
                       mode:${this.resetMode}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid: this.slug, message:comando})
           },
           resetNoSignalImage(){
               this.$inertia.socket.emit("mensaje",{uid: this.slug, message:`{"func": "resetNoSignalImage"}`})
           },
           sendKey(){
               var comando=`{
                   "func": "sendKey",
                   "options":{
                       virtualKeyCode:${this.virtualKeyCode}
                   }
               }`;
               this.$inertia.socket.emit("mensaje",{uid: this.slug, message:comando})
           },
           sendRS232CData(){
               var comando=`{
                   "func": "sendRS232CData",
                   "options":{
                       data:"3B1C42",
                       dataLength:3
                   }
               }`;
               this.$inertia.socket.emit("mensaje",{uid: this.slug, message:comando})
           },
           setDigitalAudioInputMode(){
               var comando=`{
                   "func": "setDigitalAudioInputMode",
                   "options":{
                       digitalAudioInput:${this.digitalAudioInput}
                   }
                }`;
                console.log(comando)
                this.$inertia.socket.emit("mensaje",{uid: this.slug, message:comando})
           },
           setFailoverMode(){
               var comando=`{
                   "func": "setFailoverMode",
                   "options":{
                       mode:${this.failoverMode.mode},
                       priority:[
                           "ext://HDMI:1",
                           "ext://HDMI:1",
                           "ext://HDMI:1",
                           "ext://HDMI:1"
                       ]
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setIntelligentAuto(){
               var comando=`{
                   "func":"setIntelligentAuto",
                   "options":{
                       enabled:${this.intelligentAuto}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setIsmMethod(){
               var comando=`{
                   "func": "setIsmMethod",
                   "options":{
                       ismMethod:Signage.IsmMethod.${this.signageInfo.ismMethod}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setLanDaisyChain(){
               var comando=`{
                   "func": "setLanDaisyChain",
                   "options":{
                       enabled:${this.lanDaisyChain}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setMirrorMode(){
               var comando=`{
                   "func": "setMirrorMode",
                   "options":{
                       mode:"${this.mirrorMode}"
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setNoSignalImageMode(){
               var comando=`{
                   "func": "setNoSignalImageMode",
                   "options":{
                       noSignalImageMode: "${this.noSignalImage}"
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setPortraitMode(){
               var comando=`{
                   "func": "setPortraitMode",
                   "options":{
                       portraitMode:Signage.OsdPortraitMode.${this.signageInfo.portraitMode}
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setPowerSaveMode(){
               var comando=`{
                   "func":"setPowerSaveMode",
                   "options":{
                        powerSaveMode:{
                            ses:${this.powerSaveMode.ses},
                            dpmMode:Signage.DpmMode.${this.powerSaveMode.dpmMode},
                            automaticStandby: Signage.AutomaticStandbyMode.${this.powerSaveMode.automaticStandby},
                            do15MinOff: ${this.powerSaveMode.do15MinOff}                       
                        }
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setQuietMode(){
               var comando=`{
                   "func": "setQuietMode",
                   "options":{
                       mode: "${this.quietMode}"
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setRS232CConfiguration(){
               var comando=`{
                   "func":"setRS232CConfiguration",
                   "options":{
                        mode : Signage.RS232C.Mode.MODE_1,
                        port : 3,
                        baudRate : Signage.RS232C.BaudRate.BR_9600,
                        dataBit : Signage.RS232C.DataBit.BIT_8,
                        parity : Signage.RS232C.Parity.NONE,
                        stopBit : Signage.RS232C.StopBit.BIT_1,
                        flowControl : Signage.RS232C.FlowControl.NONE,
                        rxTimeoutInMs : 0
                   }
               }`
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setSimplinkStatus(){
               var comando=`{
                   "func":"setSimplinkStatus",
                   "options":{
                       simplinkEnable:"${this.simplinkStatus}"
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           },
           setUsagePermission(){
               var comando=`{
                   "func": "setUsagePermission",
                   "options":{
                       policy:{
                            remoteKeyOperationMode: Signage.KeyOperationMode.${this.usagePermission.remoteKeyOperationMode},
                            localKeyOperationMode: Signage.KeyOperationMode.${this.usagePermission.localKeyOperationMode}
                       }
                   }
               }`;
               console.log(comando)
               this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
           }

        }
    })
</script>
