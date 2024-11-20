<x-mail::message>
    # Introduction
    Welcome {{$client->name}}
    your Code is {{$client->code}}.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
