@component('mail::message')

# {{$title}}
{{-- ![DemoImage](https://nfc.altechs.africa/storage/img/nfc/profile/mbom.jpg) --}}
![DemoImage](https://nfc.altechs.africa/storage/img/{{$image}})

{{$greeting .' '. $name}}

{{$content}}

{{-- @component('mail::button', ['url' => 'https://altechs.africa'])
Button Text
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
