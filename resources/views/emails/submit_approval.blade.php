<h2>Hello {{ $body['name'] }},</h2>

<div style="margin-bottom: 10px;">
Please find attachment,
</div>
<div style="width:100%;display:inline-flex;text-align:center;margin-bottom:10px;">
<div style="margin-right:20px;">
<a href="{{ $body['url_a'] }}" style="background-color: green;color:white;padding:5px;border-radius:5px">Approve and Pay</a>
</div>
<div>
    <a href="{{ $body['url_b'] }}" target="_blank" style="background: red;color:white;padding:5px;border-radius:5px" > Reject </a>
</div>
</div>

Thanks,<br>
{{ config('app.name') }}
