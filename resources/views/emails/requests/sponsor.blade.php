@component('mail::message')
# Solicitud - Patrocinador

Company: {{ $user->company }} <br>
Industry: {{ $user->industry }}<br>
Email: {{ $user->email }}<br>
Nombre de contacto: {{ $user->name }}<br>
Télefono: {{ $user->phone }}<br>


{{ config('app.name') }}
@endcomponent
