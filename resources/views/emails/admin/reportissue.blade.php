@component('mail::message')
# Issue Reported

{{$issue}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
