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
                                        {{ __('#') }}
                                    </th>
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
                                        class=" x-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.time') }}
                                    </th>
                                    <th scope="col"
                                        class="relative text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="relative px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span class="sr-only">{{ __('common.edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs font-bold text-gray-900">
                                                    {{ $num++ }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs font-bold text-gray-900">
                                                    {{ $order->user->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-xs font-bold text-indigo-800">
                                                    <a href="tel:{{ $order->phone }}">
                                                        {{ $order->phone }}
                                                    </a>
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
                                        <td
                                            class="px-6 py-3 flex justify-between whitespace-nowrap text-right text-sm font-bold">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white text-center py-1 px-3 rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($order->status == config('const.approve') || $order->status == config('const.reject'))
                                                <p class="px-3 py-1 rounded text-white text-xs font-bold {{ $order->status == config('const.reject') ? 'bg-red-400 px-7'  : 'bg-green-400 ' }} ">
                                                    {{ $order->status == config('const.reject') ? __('common.rejected') : __('common.accepted') }}
                                                </p>
                                            @else
                                                <form action="{{ route('admin.stateOrder', $order->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="inline-block bg-indigo-500 hover:bg--700 text-white text-center py-1 px-3 rounded">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.rejectOrder', $order->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded"
                                                        onclick="return confirm('Are you sure to remove this products ?')">
                                                        <i class="fas fa-window-close"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white">
            {{ $orders->links() }}
        </div>
        @if (session()->has('alert'))
            <script type="text/javascript">
                alert('{{ session()->get('alert') }}')
            </script>
        @endif
    </x-slot>
</x-app-layout>
