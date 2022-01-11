@component('mail::message')
<h1>{{ __('common.report_sales') . $month . '/' . $year }}</h1>
{{-- <h3>{{ __('common.name') . ' : ' . $name }}</h3>
<h3>{{ __('common.address') . ' : ' . $address }}</h3>
<h3>{{ __('common.phone') . ' : ' . $phone }}</h3> --}}
@component('mail::table')
@php
    $num = 1;
    $total = 0;
@endphp
|   {{ __('#') }}   |   {{ __('common.product') }}  |   {{ __('common.color') }}    |   {{ __('common.memory') }}   |   {{ __('common.quantity') }}     |   {{ __('common.price') }}     |  {{ __('common.total') }}    |
| ----------------- |:-----------------------------:|:-----------------------------:|:-----------------------------:|:---------------------------------:|:------------------------------:|  ---------------------------:|
@foreach ($reports as $report)
    @foreach ($report->orderDetails as $item)
|  {{ $num++ }}     |   {{ $item->product->name }}  |   {{ $item->color->name }}    |   {{ $item->memory->rom }}    |   {{ $item->quantity }}           |   {{ number_format($item->price) }}$           |  {{ number_format($item->price * $item->quantity) }}$    |
    @endforeach
@endforeach
@foreach ($reports as $report)
    @foreach ($report->orderDetails as $vl)
        @php
            $total += $vl['price'] * $vl['quantity'];
        @endphp
    @endforeach
@endforeach
@endcomponent
<h3 style="float: right; background: rgb(38, 148, 38); padding: 5px 10px; color: white">
    {{ __('common.total') . ' : ' . number_format($total) }}$
</h3>
@endcomponent
