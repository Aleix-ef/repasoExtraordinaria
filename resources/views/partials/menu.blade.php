<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Inici') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('equips.index')" :active="request()->routeIs('equips.index')">
        {{ __('Llista d\'Equips') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('estadis.index')" :active="request()->routeIs('estadis.index')">
        {{ __('Llistat d\'Estadis') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('jugadors.index')" :active="request()->routeIs('jugadors.index')">
        {{ __('Llistat de Jugadores') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('partits.index')" :active="request()->routeIs('partits.index')">
        {{ __('Llistat de Partits') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('estadis.create')" :active="request()->routeIs('estadis.create')">
        {{ __('Crear Estadi') }}
    </x-nav-link>
</div>
