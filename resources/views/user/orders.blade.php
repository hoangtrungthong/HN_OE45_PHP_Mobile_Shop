<x-guest-layout>
    <x-slot name="slot">
        <div class="flex flex-col mt-16">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('#') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.image') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.name') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.color') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.memory') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.price') }}
                                    </th>
                                    <th scope="col"
                                        class=" x-6  py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.quantity') }}
                                    </th>
                                    <th scope="col"
                                        class=" x-6  py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.time') }}
                                    </th>
                                    <th scope="col"
                                        class="x-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.total') }}
                                    </th>
                                    <th scope="col"
                                        class="x-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <p class="sr-only"> {{ __('common.edit') }}</p>
                                    </th>
                                    <th scope="col"
                                        class="x-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <p class="sr-only"> {{ __('common.edit') }}</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $total = 0;
                                    $num = 1;
                                @endphp
                                @if (count($orders))
                                    @foreach ($orders as $order)
                                        @foreach ($order->orderDetails as $items)
                                            <tr>
                                                <td class="whitespace-nowrap w-1/7">
                                                    <div class="text-black text-center">
                                                        {{ $num++ }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap w-1/6">
                                                    <div class="flex items-center">
                                                        <img src="{{ Storage::url($items->image ?? '') }}"
                                                            alt="Image">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <p class="text-sm text-center font-medium text-gray-900">
                                                        {{ $items->product->name }}
                                                    </p>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <p class="text-sm text-center font-medium text-gray-900">
                                                        {{ $items->color->name }}
                                                    </p>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <p class="text-sm text-center font-medium text-gray-900">
                                                        {{ $items->memory->rom }}
                                                    </p>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ number_format($items->price) }}$
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $items->quantity }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $items->created_at }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ number_format($items->price * $items->quantity) }}$
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div
                                                        class=" {{ $order->status == config('const.pending') ? 'bg-green-400' : __('common.reject') }} bg-red-400 text-white-500 p-1 border-green-600 font-medium text-xs leading-tight capitalize rounded transition duration-150 ease-in-out">
                                                        {{ $order->status == config('const.pending') ? __('common.wait') : __('common.rejected') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex justify-center gap-1">
                                                        <form action="{{ route('user.destroyOrder', $order->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded"
                                                                onclick="return confirm('Are you sure to remove this products ?')">
                                                                <i class="fas fa-window-close"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center px-6 py-3 text-sm font-medium text-gray-500 whitespace-nowrap"
                                            colspan="9">
                                            {{ __('common.empty') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @if (count($orders))
                            @foreach ($orders as $ord)
                                @foreach ($ord->orderDetails as $val)
                                    @php
                                        $total += $val->price * $val->quantity;
                                    @endphp
                                @endforeach
                            @endforeach
                            <div
                                class="flex pr-40 gap-5 justify-end text-gray-600 uppercase font-bold bg-white col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>{{ __('Total:') }}</p>
                                <p>{{ number_format($total) }}$</p>
                            </div>
                        @endif
                        <div class="flex justify-between px-4 py-3 bg-white text-right sm:px-6">
                            <a href="{{ route('home') }}"
                                class="gradient inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('common.back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                {{ $orders->links() }}
            </div>
    </x-slot>
</x-guest-layout>
