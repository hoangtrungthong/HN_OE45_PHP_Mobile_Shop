<x-app-layout>
    <x-slot name="slot">
        <div class="flex flex-col mt-16">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.customer') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.phone') }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.address') }}
                                    </th>
                                    <th scope="col"
                                        class=" x-6  py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.time') }}
                                    </th>
                                    <th scope="col"
                                        class="x-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.total') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('common.edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($orders))
                                    @foreach ($orders as $order)
                                            <tr>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-xs font-bold text-gray-900">
                                                            {{ $order->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-xs font-bold text-gray-900">
                                                            {{ $order->phone }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-xs font-bold text-gray-900">
                                                            {{ $order->address }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-xs font-bold text-gray-900">
                                                        {{ $order->created_at }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-center whitespace-nowrap">
                                                    <div class="text-xs font-bold text-gray-900">
                                                        {{ $order->sum_amount }}
                                                    </div>
                                                </td>
                                                <td class=" px-6 py-3 whitespace-nowrap text-right text-sm font-bold">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white text-center py-1 px-3 rounded">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
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
            {{ $orders->links() }}
        </div>
    </x-slot>
</x-app-layout>
