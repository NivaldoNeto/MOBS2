@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text 1
@endcomponent

@component('mail::button', ['url' => ''])
Button Text 2
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
