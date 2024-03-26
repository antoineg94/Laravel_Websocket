<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Journal d\'activité') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Permets de voir les changements important du jardin et de vérifier les alertes de sécutité") }}
        </p>
    </header>
                <div class=" w-full max-w-md flex flex-col">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="text-md font-bold">12:07 le 15 janvier 2012</div>

                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-gray-500 hover:text-gray-300 cursor-pointer">

                            </div>
                            <div class="mt-4 text-gray-500 font-bold text-sm">
                                <div class="w-5 h-5 bg-red-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-gray-500 font-bold text-sm">
                        Un intrus a été détecté aux alentours du jardin!
                    </div>
                    <br>
                    <hr>
                    <br>
                </div>
</section>

<script>
    let labels = [];

    let logsDate = [];
    let logsMessage = [];
    let logsType = [];

    let client;

    let infoDate;
    let infoMessage;
    let infoType;

    infoLumiere = document.getElementById('infoLumiere');
    infoHumidite = document.getElementById('infoHumidite');
    infoTemperature = document.getElementById('infoTemperature');

    function MQTTconnect() {
        client = new Paho.MQTT.Client("172.16.72.193", 9001, "clientId" + new Date().getTime());
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        client.connect({onSuccess:onConnect});
        console.log('connecté')
    }

    function onConnect() {
        console.log("onConnect");
        client.subscribe("topicLogs");

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

        createCard(logsDate, parseFloat(message.payloadString), time);
        infoTemperature.innerHTML = message.payloadString + '°C';
    }

    function createCard(data, value, time) {
        const mainDiv = document.createElement('div');
        mainDiv.classList.add('w-full', 'max-w-md', 'flex', 'flex-col');

        const innerDiv = document.createElement('div');
        innerDiv.classList.add('flex', 'items-center', 'justify-between');

        const timeDiv = document.createElement('div');
        timeDiv.classList.add('flex', 'items-center', 'space-x-4', 'text-md', 'font-bold');
        timeDiv.textContent = time; // Set the time

        const actionsDiv = document.createElement('div');
        actionsDiv.classList.add('flex', 'items-center', 'space-x-4');

        const iconDiv = document.createElement('div');
        iconDiv.classList.add('text-gray-500', 'hover:text-gray-300', 'cursor-pointer');

        const statusDiv = document.createElement('div');
        statusDiv.classList.add('mt-4', 'text-gray-500', 'font-bold', 'text-sm');

        const statusInnerDiv = document.createElement('div');
        statusInnerDiv.classList.add('w-5', 'h-5', 'rounded-full');

        function setColorBasedOnAlertType(infoType) { // Set the color based on the alert type
            switch (alertType) {
                case 'intrusion':
                    statusInnerDiv.classList.add('bg-red-500');
                    break;
                case 'warning':
                    statusInnerDiv.classList.add('bg-yellow-500');
                    break;
                case 'info':
                    statusInnerDiv.classList.add('bg-blue-500');
                    break;
                default:
                    statusInnerDiv.classList.add('bg-gray-500');
                    break;
            }
        }

        const statusText = document.createTextNode();
        statusText.textContent = alertMessage; // Set the alert message

        const br = document.createElement('br');
        const hr = document.createElement('hr');

        // Append child
        actionsDiv.appendChild(iconDiv);
        statusDiv.appendChild(statusInnerDiv);
        actionsDiv.appendChild(statusDiv);
        innerDiv.appendChild(timeDiv);
        innerDiv.appendChild(actionsDiv);
        mainDiv.appendChild(innerDiv);
        mainDiv.appendChild(document.createTextNode(' '));
        mainDiv.appendChild(statusText);
        mainDiv.appendChild(br);
        mainDiv.appendChild(hr);

        // Append the main div to the body
        document.body.appendChild(mainDiv);
    }


    window.onload = function() {
        MQTTconnect();
            lightIntensityChart = new Chart(document.getElementById('lightIntensityChart').getContext('2d'), createChartConfig('Intensité Lumineuse', lightIntensityData, 'Intensité Lumineuse (lux)'));
    }; 
</script>