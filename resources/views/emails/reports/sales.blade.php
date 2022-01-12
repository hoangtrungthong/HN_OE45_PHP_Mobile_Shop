@component('mail::message')
<h1>{{ __('common.report_sales') . $month . '/' . $year }}</h1>
@component('mail::table')
@php
    $num = 1;
    $total = 0;
@endphp
|   {{ __('#') }}   |   {{ __('common.product') }}  |   {{ __('common.color') }}    |   {{ __('common.memory') }}   |   {{ __('common.quantity') }}     |   {{ __('common.price') }}     |  {{ __('common.total') }}    |
| ----------------- |:-----------------------------:|:-----------------------------:|:-----------------------------:|:---------------------------------:|:------------------------------:|  ---------------------------:|
@foreach ($reports as $item)
|  {{ $num++ }}     |   {{ $item->product->name }}  |   {{ $item->color->name }}    |   {{ $item->memory->rom }}    |   {{ $item->total_qty }}           |   {{ number_format($item->price) }}$           |  {{ number_format($item->price * $item->total_qty) }}$    |
@endforeach
@foreach ($reports as $vl)
    @php
        $total += $vl['price'] * $vl['total_qty'];
    @endphp
@endforeach
@endcomponent
<h3 style="float: right; background: rgb(38, 148, 38); padding: 5px 10px; color: white">
    {{ __('common.total') . ' : ' . number_format($total) }}$
</h3>
@endcomponent
