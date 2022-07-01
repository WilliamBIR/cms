<template>
    <div>
            <h3>Security</h3>
    </div>
     <div>
        <h4 style="text-align:center; font-size:30px"> Certificados </h4>
        <a @click.prevent="getServerCertificateList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Consultar</a>          
    </div>
    <div>
        <h4 style="text-align:center; font-size:30px"> Registrar certificado </h4>
        <a @click.prevent="registerServerCertificateList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Registrar</a>          
    </div>
    <div>
        <h4 style="text-align:center; font-size:30px"> Borrar todos los certificados </h4>
        <a @click.prevent="unregisterAllServerCertificateList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Borrar</a>          
    </div>
    <div>
        <h4 style="text-align:center; font-size:30px"> Borrar dominios </h4>
        <a @click.prevent="unregisterServerCertificateList" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 disabled:opacity-25 transition ml-4">Borrar dominios</a>          
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
                serverCertificateList:[],
                unregisteredServerCertificateList:[]
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
                    if(payload.request.function == "getServerCertificateList"){ this.serverCertificateList=payload.message;console.log(this.serverCertificateList)};  
                    if(payload.request.function == "unregisterServerCertificateList"){ this.unregisteredServerCertificateList=payload.message;console.log(this.unregisteredServerCertificateList)};  
                    
                    
                }  
            }.bind((this)));
        },
        methods:{
            getServerCertificateList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "getServerCertificateList"}`})
            },
            registerServerCertificateList(){
                var comando=`{
                    "func":"registerServerCertificateList",
                    "options":{
                        serverCertificateList: [\
                            -----BEGIN CERTIFICATE-----\n\
                            MIIDhDCCAmwCCQDY8/8psTWE+DANBgkqhkiG9w0BAQsFADCBgzELMAkGA1UEBhMC\n\
                            S1IxDjAMBgNVBAgMBVNlb3VsMQ4wDAYDVQQHDAVTZW91bDEMMAoGA1UECgwDTEdF\n\
                            MQwwCgYDVQQLDANXTVQxFjAUBgNVBAMMDTEwLjE3Ny4yMjUuNTgxIDAeBgkqhkiG\n\
                            9w0BCQEWEWRvb21zZGF5QGtsZHAub3JnMB4XDTE2MDkyMzEwMzY0MloXDTI2MDky\n\
                            MTEwMzY0MlowgYMxCzAJBgNVBAYTAktSMQ4wDAYDVQQIDAVTZW91bDEOMAwGA1UE\n\
                            BwwFU2VvdWwxDDAKBgNVBAoMA0xHRTEMMAoGA1UECwwDV01UMRYwFAYDVQQDDA0x\n\
                            MC4xNzcuMjI1LjU4MSAwHgYJKoZIhvcNAQkBFhFkb29tc2RheUBrbGRwLm9yZzCC\n\
                            ASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBANGU2B1m93M1Wtm1Bvz7BF7S\n\
                            ATx7IWB5bE9fteMJmhvb5yYIcwKbBtPBdIyywPe9ROSHiYHubW3GCbw/h/CjC7F6\n\
                            gvKGK+Hg6lF2fXVDbR4+qDPoiVY+dv/ZWbaQ2KDjMHSqfHqlZWIqm4Znp4mx3dL1\n\
                            DAt2I/S5jcKkO9Xf4g5RCW5dEMTpv0aNgm1nd6YMOGmO0F0r/HwlLNr4cdJwRBWv\n\
                            Ce99EZ3H5SY+Iat96sXDQPxfmBtN1H71Hi1+kZ0ugDhLVTEQxq68cXH0QSnWttXx\n\
                            p4P1DBWYJswQrjiWP9SXLCTPBawNRnSkSGpqoconhy8xDnp1jvEEd/zpWAh036MC\n\
                            AwEAATANBgkqhkiG9w0BAQsFAAOCAQEAKzlLlueFKWfo9IGUdQ/RLjBXD+gBtwF9\n\
                            T8qkIA0h8eawK3l4pBjXgyvIybhhnF3q+aBDD6nh0anhnzmlrzyWqWefsVQqDKEG\n\
                            iqb01qo8qOAn84pAliOnsNQEx+D1Rb2+ceRUhEYLxZBDbL9iL8MuNPAW7coFw3nm\n\
                            eTGV1Nx3OUfK9/EcGbEzNkFP8ZMkckbiDrF5rGHClqL+9FeQ03XMIPGqil2Te6Xq\n\
                            vKG3nsUYZymir2Dgl7Z6Vkeo+F8Y6CPD+iIxkgfX+QKRYS/dYoN00o7fsHNJN7WM\n\
                            CXqAtsTiHRfF17xHVjXH3HLqR5sIpQqay2RZE2PDQpc7Gaq+L9U81A==\n\
                            -----END CERTIFICATE-----\n", "\
                            -----BEGIN CERTIFICATE-----\n\
                            MIIDXzCCAkegAwIBAgIJALispfP+z4ZZMA0GCSqGSIb3DQEBBQUAMEYxCzAJBgNV\n\
                            BAYTAktSMQwwCgYDVQQHDANMR0UxDzANBgNVBAoMBkNUTyBDQTEYMBYGA1UEAwwP\n\
                            amtjbG91ZC5sZ2UuY29tMB4XDTE2MDMxNzAzMDUzMFoXDTI2MDMxNTAzMDUzMFow\n\
                            RjELMAkGA1UEBhMCS1IxDDAKBgNVBAcMA0xHRTEPMA0GA1UECgwGQ1RPIENBMRgw\n\
                            FgYDVQQDDA9qa2Nsb3VkLmxnZS5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAw\n\
                            ggEKAoIBAQCwdor7TwwIIuTI8HvOBx//cBlu+xE1L/9ZAWaIRivK/O/1Bv+jTxpx\n\
                            5RN9RttmJle9QS8Tx6/Wf40REt9Lnc1fUCdVILSkTrcHY4Wcc5cqvt0Uz17kcaTJ\n\
                            Q6Ch2wiyq2ZSj2vTQAhQfV0cpvwJTYKwXCSeL8M10KZqeU/41PITp/67MzCZF+BT\n\
                            gTm60UTfrc/Owe8q2yn3di7wKiuEwP5WROGa/HkOrWJfkx0DjAlO79tZoUmyd4RH\n\
                            C6R3ST8lbCMtttDd8JGHlCSVRf9NIQc71M88vgYY7Dh9POfCfhxkVA9/ws5h7aHt\n\
                            t0vAqmRN6vgFhBPhmTUp+eoUl+3nf0aVAgMBAAGjUDBOMB0GA1UdDgQWBBQkXPyq\n\
                            koD+LlrJgYRvkiqg5KDJJTAfBgNVHSMEGDAWgBQkXPyqkoD+LlrJgYRvkiqg5KDJ\n\
                            JTAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4IBAQCcK/JXi0aaQ1RiToTK\n\
                            stYpMZjTtmiDqgpdHkhsU0H2EwVW46j4xaALzLoSWx4neREJS1KPJ4Wh6PT9554S\n\
                            wI/9yIjiqJlsHmU3h3FxjO5NRO9Qu+o9MeLAGAJs9M49NS0TiJYo1V7beyI5ju99\n\
                            xs887ac5F/Axg3Pb4sX1Wo5xTB2Bw+bKMHj0Rk+9uDrGqsrPpX39R8CL0W/1ISU5\n\
                            ioOvHBHeyw2PzqO4KbIXrvj0dihDBWc/SltS/4htXs4JL76rA7+Byj9AUVxrm2QK\n\
                            gmsignOklllYUkLdIjLPyJy8tDUFTcR4oElWN+mGME4zl0x8mCaTaPf8niBw9hfI\n\
                            Cymj\n\
                            -----END CERTIFICATE-----\n
                            ]
                    }
                }`;
                console.log("registrando")
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:comando})
            },
            unregisterAllServerCertificateList(){
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message:`{"func": "unregisterAllServerCertificateList"}`})
            },
            unregisterServerCertificateList(){
                var comando=`{
                    "func": "unregisterServerCertificateList",
                    "options":{
                        domainNameList:["*.procentric.com", "*.lge.com"]
                    }
                }`
                this.$inertia.socket.emit("mensaje",{uid:this.slug, message: comando})
            }
        }
    })
</script>
