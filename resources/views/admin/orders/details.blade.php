<x-app-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full h-full bg-white">
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">{{ __('common.order_date') }} : <span class="text-sm font-medium"> {{ $orderDetails[0]->order->created_at }}</span></h6>
                        <h6 class="font-bold">{{ __('common.order_id') }} : <span class="text-sm font-medium">{{ $orderDetails[0]->order->id }}</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold">Ship To :</span>
                            <ul>
                                <li>{{ $orderDetails[0]->order->user->name }}</li>
                                <li>{{ $orderDetails[0]->order->user->phone }}</li>
                                <li>{{ $orderDetails[0]->order->user->address }}</li>
                            </ul>
                        </address>
                    </div>
                    <div></div>
                </div>
                <div class="flex justify-center p-4 w-full">
                    <div class="border-b border-gray-200 w-full">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        #
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                       {{ __('common.product') }}
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                       {{ __('common.color') }}
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                       {{ __('common.memory') }}
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        {{ __('common.quantity') }}
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        {{ __('common.price') }}
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        {{ __('common.total') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @php
                                    $num = 1;
                                    $total = 0;
                                @endphp
                                @foreach ($orderDetails as $key => $item)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $num++ }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                           {{ $item->product->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">{{ $item->color->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $item->memory->rom }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->price * $item->quantity }}
                                    </td>
                                </tr>
                                @endforeach
                                @foreach ($orderDetails as $vl)
                                    @php
                                        $total += $vl['price'] * $vl['quantity'];
                                    @endphp
                                @endforeach
                                <tr class="text-white bg-gray-800">
                                    <th colspan="5"></th>
                                    <td class="text-sm font-bold"><b>Total</b></td>
                                    <td class="text-sm font-bold"><b>{{ number_format($total) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index') }}"
                    class="ml-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-circle-left"></i>
                    {{ __('common.back') }}
                </a>
            </div>
        </div>
    </x-slot>
</x-app-layout>
