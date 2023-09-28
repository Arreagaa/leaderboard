@component('mail::message')
# Registrado de sponsor

Hola {{ $user->company }}, gracias por interesarte en Tecuman Invitational. <br>
<br>
Pronto nos pondremos en contacto contigo. <br>

¡Te esperamos!,<br>
{{ config('app.name') }}
@endcomponent
