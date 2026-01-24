<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <p class="text-3xl text-center">
        <i class="fa-solid fa-thumbs-up me-2">A nossa view</i>
    </p>
    <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm">Sair</a>

</x-layouts.guest-layout>
