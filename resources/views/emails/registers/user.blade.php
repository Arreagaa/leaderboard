@component('mail::message')
# Registrado a {{ $user->type }}

Hola {{ $user->name }}, hemos confirmado tu registro. <br>
Usa este Código QR para entrar.
<br /><br />
<div style="text-align: center; width: 100%; padding-botton: 1.5rem">
    <img src="{{asset($user->qr)}}" width="275px">
</div>

¡Te esperamos!,<br>
{{ config('app.name') }}
@endcomponent
