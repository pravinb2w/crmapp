@component('mail::message')
<h2>Hello {{$body['name']}},</h2>

<div>
    Please find attachment,
</div>
<div style="width:100%;display:inline-flex;text-align:center">
   <div style="margin-right:20px;">
        @component('mail::button', ['url' => $body['url_a'], 'color' => 'success'])
        Approve
        @endcomponent
   </div>
   <div>
        @component('mail::button', ['url' => $body['url_b']])
        Reject
        @endcomponent
   </div>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
