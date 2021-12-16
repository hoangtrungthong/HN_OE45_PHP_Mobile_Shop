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
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($orders))
                                    @foreach ($orders as $order)
                                        @foreach ($order->orderDetails as $items)
                                            <tr>
                                                <td class="px-6 py-3 whitespace-nowrap w-1/6">
                                                    <div class="flex items-center">
                                                        <img src="{{ Storage::url($items->image ?? '') }}"
                                                            alt="Image">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $items->product->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $items->color->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $items->memory->rom }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ number_format($items->price) }}
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
                                                        {{ number_format($items->price * $items->quantity) }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center px-6 py-3 text-sm font-medium text-gray-500 whitespace-nowrap"
                                            colspan="7">
                                            {{ __('common.empty') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white">
            {{$orders->links()}}
        </div>
    </x-slot>
</x-guest-layout>
