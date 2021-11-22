@component('mail::message')
# Hi {{ $user->name }},

<p>We're pleased to inform you that your acount has been apporved. Now you may login and enjoy all features.</p>
<p>Again, Thank you for joining us.</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent