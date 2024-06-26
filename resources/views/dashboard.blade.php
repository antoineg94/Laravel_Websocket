<x-app-layout>

    <x-slot name="header">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
        <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
        </style>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="relative block h-500-px">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
                background-image: url('https://www.treehugger.com/thmb/O09mnhgsoNuDGw_774a2KRK2ICE=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/beautiful-garden-with-leafy-vegetables-and-bright-colored-flowers-149164106-af0626f36c6647188ed9fae5a738a18b.jpg');">
          <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
          <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </section>

    <section class="relative py-16 bg-blueGray-200">
        <div class="container mx-auto px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
            <div class="px-6">
              <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                  <div class="relative">
                    <img src="https://howtoculinaryherbgarden.com/wp-content/uploads/2020/02/smart-soil.jpg" class="shadow-xl rounded-full h- align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"/>
                  </div>
                </div>
              </div>
              <div class="text-center mt-12">
                <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 mb-2">
                  Jardin IoT
                </h3>
              </div>
              <div class="min-h-screen">
                <div class="mx-auto max-w-3xl px-6 py-12">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-16">
                    <div class="bg-white rounded-lg shadow-md p-6">
                      <h2 class="text-xl font-bold mb-4">Température</h2>
                      <strong id="infoTemperature">Aucune donnée</strong>
                      <p class="text-gray-700">La température ambiante dans le jardin intelligent est maintenue à un niveau optimal, assurant des conditions idéales pour la croissance des plantes.</p>
                    </div>
                    <div class="p-6">
                      <p class="text-center">Variation de Température</p>
                      <canvas id="temperatureChart"></canvas>   
                    </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-16">
                    <div class="p-6">
                      <p class="text-center">Variation d'Intensité Lumineuse</p>
                      <canvas id="lightIntensityChart"></canvas>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-4">Lumière</h2>
                        <strong id="infoLumiere">Aucune donnée</strong>
                        <p class="text-gray-700">Le niveau de lumière est contrôlé, garantissant un éclairage optimal pour favoriser la photosynthèse et la santé des plantes dans le jardin intelligent.</p>
                      </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-16">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold mb-4">Humidité</h2>
                        <strong id="infoHumidite">Aucune donnée</strong>
                        <p class="text-gray-700">Le taux d'humidité dans le jardin intelligent est maintenu à un certain niveau, assurant des conditions de croissance optimales pour les plantes tout en prévenant les maladies liées à l'humidité excessive ou insuffisante.</p>
                      </div>
                      <div class="p-6">
                        <p class="text-center">Variation d'Humidité</p>
                        <canvas id="humidityChart"></canvas>
                      </div>
                  </div>
                  <div class="mx-auto max-w-3xl px-6 py-12">  
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-16">
                        
                          <button id="publishLightSwitch" onclick="toggleLight()">
                          <div class="rounded-lg shadow-md p-6 transition duration-300 hover:bg-gray-100"  >
                              <h2 class="text-xl font-bold mb-4">État des lumières</h2>
                              <strong id="etatLumieres">Allumé / Éteinte</strong> 
                            </div>
                          </button>
                          <div class="bg-white rounded-lg shadow-md p-6">
                              <h2 class="text-xl font-bold mb-4">État de la sécurité</h2>
                              <strong id="etatSecurite">Aucune donnée</strong>
                            </div>
                            <div class="bg-white rounded-lg shadow-md p-6">
                              <h2 class="text-xl font-bold mb-4">État de la pompe</h2>
                              <strong id="etatPompe">Allumé / Éteinte</strong>
                            </div>
                            <div class="bg-white rounded-lg shadow-md p-6">
                              <h2 class="text-xl font-bold mb-4">État de du sol</h2>
                              <strong id="etatSol">Aucune donnée</strong>
                            </div>
                      </div>
                  </div>
            </div>
        </div>
    <style>
      .card:hover {
        transform: rotateY(180deg);
        transform-style: preserve-3d;
      }

      .card-back {
        transform: rotateY(180deg);
      }
    </style>
        <script>
            let labels = [];
            let temperatureData = [];
            let humidityData = [];
            let lightIntensityData = [];
            let client;

            let infoLumiere;
            let infoHumidite;
            let infoTemperature;

            let etatLumieres;
            let etatPompe;
            let etatSol;
            let etatSecurite;
            let isLightOn = '';

            let etatLightSwitch;

            infoLumiere = document.getElementById('infoLumiere');
            infoHumidite = document.getElementById('infoHumidite');
            infoTemperature = document.getElementById('infoTemperature');

            etatLumieres = document.getElementById('etatLumieres');
            etatPompe = document.getElementById('etatPompe');
            etatSol = document.getElementById('etatSol');
            etatSecurite = document.getElementById('etatSecurite');
    
            function MQTTconnect() {
                client = new Paho.MQTT.Client("172.16.72.193", 9001, "clientId" + new Date().getTime());
                client.onConnectionLost = onConnectionLost;
                client.onMessageArrived = onMessageArrived;
                client.connect({onSuccess:onConnect});
                console.log('connecté')
            }
    
            function onConnect() {
                console.log("onConnect");
                client.subscribe("topicTemperature");
                client.subscribe("topicHumidite");
                client.subscribe("topicLumiere");
                client.subscribe("topicEtatEclairage");
                client.subscribe("topicSenseurHumidite");
                client.subscribe("topicIntrus");
            }
    
            function onConnectionLost(responseObject) {
                if (responseObject.errorCode !== 0) {
                    console.log("onConnectionLost:" + responseObject.errorMessage);
                }
            }
    
            function onMessageArrived(message) {
                console.log("onMessageArrived: Topic=" + message.destinationName + ", Message=" + message.payloadString);
                let now = new Date();
                let time = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
    
                switch(message.destinationName) {
                    case "topicTemperature":
                        updateChart(temperatureChart, temperatureData, parseFloat(message.payloadString), time);
                        infoTemperature.innerHTML = message.payloadString + '°C';
                        break;
                    case "topicHumidite":
                        updateChart(humidityChart, humidityData, parseFloat(message.payloadString), time);
                        infoHumidite.innerHTML = message.payloadString + '%';
                        break;
                    case "topicLumiere":
                        updateChart(lightIntensityChart, lightIntensityData, parseFloat(message.payloadString), time);
                        infoLumiere.innerHTML = message.payloadString + ' lux';
                        break;
                      case "topicEtatEclairage": // Ajoutez ce cas pour traiter le message pour le contrôle des LED
                        isLightOn = message.payloadString
                        break;
                    case"topicSenseurHumidite":
                        isPumpOn = message.payloadString
                        updateEtatPompe();
                        updateEtatSol();
                        break; 
                    case"topicIntrus":
                        isSecurityOn = message.payloadString
                        updateEtatSecurite();
                        break; 
                }
            }
    
            function updateChart(chart, data, value, time) {
                data.push(value);
                if(data.length > 20) {
                    data.shift();
                }
                if(labels.length > 20) { 
                    labels.shift();
                }
                if(labels.length === 0 || labels[labels.length - 1] !== time) {
                    labels.push(time);
                }
                chart.update();
            }
    
            function createChartConfig(label, data, yAxisLabel) {
                return {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            backgroundColor: 'rgba(125, 218, 88, 0.6)',
                            borderColor: 'rgba(125, 218, 88, .6)',
                            borderWidth: 1,
                            data: data,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                title: {
                                    display: true,
                                    text: yAxisLabel
                                }
                            }
                        }
                    }
                };
            }
    
            function toggleLight() {
            let newStatus = (isLightOn === "on") ? "off" : "on";
            const message = new Paho.MQTT.Message(newStatus);
            message.destinationName = "topicEtatEclairage";
            client.send(message);
            let newStatusMessage = (newStatus === "on") ? "Allumé" : "Éteinte";
            etatLumieres.innerHTML = newStatusMessage;
            console.log('message sent: ' + newStatus)
        }

        function updateEtatSol() {
            let newStatus;
            if (isPumpOn === "sec") {
                newStatus = "Le sol est sec";
            } 
            if (isPumpOn === "humide") {
                newStatus = "Le sol est humide";
            } 
            if (isPumpOn === "presquesec") {
                newStatus = "Le sol est presque sec";
            } 
            if (isPumpOn === "presquehumide") {
                newStatus = "Le sol est presque humide";
            } 
            etatSol.innerHTML = newStatus;
        }

        function updateEtatPompe() {
            let newStatus = (isPumpOn === "sec") ? "Allumé" : "Éteinte";
            etatPompe.innerHTML = newStatus;
        }
    
        function updateEtatSecurite() {
            let newStatus = (isSecurityOn === "aucunintrus") ? "Rien a signaler" : "Un intrus est aux alentours du jardin!";
            etatSecurite.innerHTML = newStatus;
        }

        document.getElementById('publishLightSwitch').onclick = function() {
          toggleLight();
        };

            window.onload = function() {
                MQTTconnect();
                temperatureChart = new Chart(document.getElementById('temperatureChart').getContext('2d'), createChartConfig('Température', temperatureData, 'Température (°C)'));
                humidityChart = new Chart(document.getElementById('humidityChart').getContext('2d'), createChartConfig('Humidité', humidityData, 'Humidité (%)'));
                lightIntensityChart = new Chart(document.getElementById('lightIntensityChart').getContext('2d'), createChartConfig('Intensité Lumineuse', lightIntensityData, 'Intensité Lumineuse (lux)'));
            };

            
        </script>
    
      </section>
</x-app-layout>
