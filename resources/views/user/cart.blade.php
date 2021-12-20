<x-guest-layout>
    <x-slot name="slot">
        <div class="flex flex-col mt-12">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('#') }}
                                    </th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.image') }}
                                    </th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.name') }}
                                    </th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.price') }}
                                    </th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.quantity') }}
                                    </th>
                                    <th scope="col"
                                        class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.total') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('common.edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (session('cart'))
                                    @php
                                        $total = 0;
                                        $num = 1;
                                    @endphp
                                    @foreach (session('cart') as $key => $val)
                                        <tr>
                                            <form action="{{ route('user.updateCart', $val['name']) }}" method="post"
                                                class="float-left mr-2">
                                                @csrf
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-center text-sm font-medium text-gray-900">
                                                            {{ $num++ }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap w-1/6">
                                                    <div>
                                                        <img class="w-full"
                                                            src="{{ Storage::url($val['image']) }}" alt="Image">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div>
                                                        <div class="text-center text-sm font-medium text-gray-900">
                                                            {{ $val['name'] }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div>
                                                        <p
                                                            class="text-center py-1 text-center border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                                                            {{ number_format(intval($val['price'])) }}$
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div class="text-center text-sm text-gray-500">
                                                        <input
                                                            class="px-4 py-1 w-1/4 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out"
                                                            type="number" name="quantity" min="1"
                                                            value="{{ $val['quantity'] }}">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 whitespace-nowrap">
                                                    <div
                                                        class="text-center py-1 text-center border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                                                        {{ number_format(intval($val['price']) * $val['quantity']) }}$
                                                    </div>
                                                </td>
                                                <td class=" px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                                    <button type="submit"
                                                        class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white text-center py-1 px-3 rounded">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button data-slug="{{ $val['name'] }}"
                                                        class="remove-cart bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <input type="hidden" name='slug' value="{{ $val['name'] }}">
                                                <input type="hidden" name='id' value="{{ $val['id'] }}">
                                                <input type="hidden" name="memory" value="{{ $val['memory'] }}">
                                                <input type="hidden" name="color" value="{{ $val['color'] }}">
                                            </form>
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
                        @if (session('cart'))
                            @foreach (session('cart') as $k => $vl)
                                @php
                                    $total += $vl['price'] * $vl['quantity'];
                                @endphp
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
                            @if (session('cart'))
                                <a href="{{ route('user.checkout') }}"
                                    onclick="return confirm('{{ __('common.confirm') }}')"
                                    class="gradient inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('common.checkout') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    @section('js')
        @if (session()->has('alert'))
            <script type="text/javascript">
                alert('{{ session()->get('alert') }}')
            </script>
        @endif
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.remove-cart').click(function(e) {
                    e.preventDefault();

                    var self = $(this);
                    if (confirm("Are you sure")) {
                        $.ajax({
                            url: 'user/remove-cart',
                            method: "delete",
                            data: {
                                slug: self.data("slug")
                            },
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    }
                })
            })
        </script>
    @endsection
</x-guest-layout>
