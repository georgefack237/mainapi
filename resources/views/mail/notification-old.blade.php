@component('mail::message')
# {{$greeting .' Me. '. $name}}
![DemoImage](https://nfc.altechs.africa/storage/img/barreau/{{$image}})

{{$content}}

{{-- @component('mail::button', ['url' => 'https://altechs.africa'])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
