<x-mail::message>
    # Introduction
    Welcome {{$user->name}}
    your Code is {{$user->code}}.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
