@component('mail::message')
# Registrado {{ $user->type }}

Hola {{ $user->name }}, te has registrado correctamente. <br>
Usa este código para entrar como espectador.
<br /><br />
<div style="text-align: center; width: 100%; padding-botton: 1.5rem">
    <img src="{{asset($user->qr)}}" width="275px">
</div>
¡Te esperamos!,<br>
{{ config('app.name') }}
@endcomponent
