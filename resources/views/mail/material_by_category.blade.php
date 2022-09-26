@component('mail::message')
Появился новый материал с вашей любимой категорией!

@component('mail::button', ['url' => route('material.show', $material->slug)])
Смотреть
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
