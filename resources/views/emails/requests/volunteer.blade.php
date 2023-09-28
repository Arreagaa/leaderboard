@component('mail::message')
# Solicitud - Voluntario

Nombre: {{ $user->name }} <br>
Apellido: {{ $user->last_name }}<br>
Email: {{ $user->email }}<br>
Experiencia: {{ $user->experience }}<br>
Edad: {{ $user->age }}<br>
Télefono: {{ $user->phone }}<br>


{{ config('app.name') }}
@endcomponent
