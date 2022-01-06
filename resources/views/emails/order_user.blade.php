@component('mail::message')
<div style="text-align: center">
    <img src="{{ asset('images/logo.png') }}" alt="{{ __('common.image') }}">
</div>
<h3>{{ __('common.name') . ' : ' . $name }}</h3>
<h3>{{ __('common.address') . ' : ' . $address }}</h3>
<h3>{{ __('common.phone') . ' : ' . $phone }}</h3>
@component('mail::table')
@php
    $num = 1;
    $total = 0;
@endphp
|   {{ __('#') }}   |   {{ __('common.product') }}  |   {{ __('common.color') }}    |   {{ __('common.memory') }}   |   {{ __('common.quantity') }}     |   {{ __('common.price') }}     |  {{ __('common.total') }}    |
| ----------------- |:-----------------------------:|:-----------------------------:|:-----------------------------:|:---------------------------------:|:------------------------------:|  ---------------------------:|
@foreach ($orderDetails as $key => $item)
|  {{ $num++ }}     |   {{ $item->product->name }}  |   {{ $item->color->name }}    |   {{ $item->memory->rom }}    |   {{ $item->quantity }}           |   {{ number_format($item->price) }}$           |  {{ number_format($item->price * $item->quantity) }}$    |
@endforeach
@foreach ($orderDetails as $vl)
    @php
        $total += $vl['price'] * $vl['quantity'];
    @endphp
@endforeach
@endcomponent
<h3 style="float: right; background: rgb(38, 148, 38); padding: 5px 10px; color: white">
    {{ __('common.total') . ' : ' . number_format($total) }}$
</h3>

<p style="padding: 40px 0 0 0">{{ __('common.msg_feedback') }}</p>
@component('mail::button', ['url' => 'https://mail.google.com/mail/u/0/#inbox?compose=new'])
{{ __('common.feedback') }}
@endcomponent

{{ __('common.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
