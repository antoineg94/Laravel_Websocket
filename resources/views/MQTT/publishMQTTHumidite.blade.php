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
        <x-primary-button class="ml-4">
            {{ __('Save') }}
        </x-primary-button>
</form>
    
</section>
