@component('mail::message')
# Registro a {{ $user->type }}

Hola {{ $user->name }}, te has registrado correctamente.

Pronto estaremos enviandote un  Código QR de entrada.

¡Te esperamos!,<br>
{{ config('app.name') }}
@endcomponent

