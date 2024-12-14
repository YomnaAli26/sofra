<x-mail::message>
# Introduction

<p>Welcome {{$client->name}}</p>

    <p>Your Code is {{$client->code}}</p>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
