<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Modifier temps de réponse MQTT (Humidité)') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Permets de changer la valeur de temps l'humidité") }}
        </p>
    </header>

    <form action="">
        <x-input-label for="temperature" :value="__('Temps de réponse (en minutes)')" />
        <x-text-input id="temperature" class="block mt-1 w-full" type="text" name="temperature" :value="old('temperature')" required autofocus />

    <div class="mt-6 flex justify-start">
        <x-primary-button id="publishButton" class="ml-4">
            {{ __('Save') }}
        </x-primary-button>
</form>
    
<script>
    let client;

    let timerHumidite;
    timerHumidite = document.getElementById('timerHumidite');

    function MQTTconnect() {
        client = new Paho.MQTT.Client("172.16.72.193", 9001, "clientId" + new Date().getTime());
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        client.connect({onSuccess:onConnect});
        console.log('connecté')
    }

    function publishMessage(timerHumidite) {
        let msg = new Paho.MQTT.Message(timerHumidite);
        msg.destinationName = "topicTimerHumidite";
        client.send(msg);
        console.log("Message published:", timerHumidite);
    }

    document.getElementById('publishButton').onclick = function() {
            publishMessage();
    };

    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    window.onload = function() {
        MQTTconnect();    
    };
</script>
</section>
