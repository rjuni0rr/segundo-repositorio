@include('users.modals.change_pw_modal')

<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    @include('layouts.dashboard')


</x-layouts.auth-layout>
