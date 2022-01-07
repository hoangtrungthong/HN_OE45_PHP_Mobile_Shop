<x-app-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full h-full bg-white">
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">{{ __('common.order_date') }} : <span class="text-sm font-medium">
                                {{ $orderDetails[0]->order->created_at }}</span></h6>
                        <h6 class="font-bold">{{ __('common.order_id') }} : <span
                                class="text-sm font-medium">{{ $orderDetails[0]->order->id }}</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold">{{ __('common.ship_to') }} :</span>
                            <ul>
                                <li>{{ $orderDetails[0]->order->user->name }}</li>
                                <li>{{ $orderDetails[0]->order->user->phone }}</li>
                                <li>{{ $orderDetails[0]->order->user->address }}</li>
                            </ul>
                        </address>
                    </div>
                </div>
                <div class="flex justify-center p-4 w-full">
                    <div class="border-b border-gray-200 w-full">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        {{ __('#') }}
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
                                        <td class="text-center px-6 py-4 text-sm text-gray-500">
                                            {{ $num++ }}
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->product->name }}
                                            </div>
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            <div class="text-sm text-gray-500">{{ $item->color->name }}</div>
                                        </td>
                                        <td class="text-center px-6 py-4 text-sm text-gray-500">
                                            {{ $item->memory->rom }}
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->price }}
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            <p class="bg-green-300 p-1 text-white">
                                                {{ $item->price * $item->quantity }}
                                            </p>
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
                                    <td class="text-sm font-bold"><b>{{ __('common.total') }}</b></td>
                                    <td class="text-sm font-bold"><b>{{ number_format($total) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('admin.orders.index') }}"
                        class="ml-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-arrow-circle-left"></i>
                        {{ __('common.back') }}
                    </a>
                    @if ($orderDetails[0]->order->status == config('const.approve') || $orderDetails[0]->order->status == config('const.reject'))
                        <p class="py-2 px-4 mr-10 rounded text-white text-xs font-bold {{ $orderDetails[0]->order->status == config('const.reject') ? 'bg-red-400 px-7'  : 'bg-green-400 ' }} ">
                            {{ $orderDetails[0]->order->status == config('const.reject') ? __('common.rejected') : __('common.accepted') }}
                        </p>
                    @else
                    <div class="flex gap-3 items-center mr-10">
                        <form action="{{ route('admin.stateOrder', $orderDetails[0]->order->id) }}"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-block bg-indigo-500 hover:bg--700 text-white text-center py-1 px-3 rounded">
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.rejectOrder', $orderDetails[0]->order->id) }}"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded"
                                onclick="return confirm('Are you sure to remove this products ?')">
                                <i class="fas fa-window-close"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
