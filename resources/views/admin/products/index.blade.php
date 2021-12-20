<x-app-layout>
    <x-slot name="slot">
        <div class="mt-14">
            <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-purple-700 text-white text-center py-2 px-4 rounded">
                {{ __('common.new') }}
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
        <div class="flex flex-col my-12">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('#') }}
                                    </th>
                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.image') }}
                                    </th>
                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.name') }}
                                    </th>
                                    <th scope="col" class=" px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.category') }}
                                    </th>
                                    <th scope="col" class=" px-6  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.quantity') }}
                                    </th>
                                    <th scope="col" class=" px-6  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('common.time') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('common.edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if (count($products))
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $num++ }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="{{ Storage::url($product->productImages[0]->path ?? '') }}" alt="Image">
                                            </div>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $product->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="flex items-center">
                                                <p class="px-4 py-1 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                                                    {{ $product->category->name ?? ''}}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ $product->productAttributes->sum('quantity') }}
                                            </div>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="text-sm text-gray-500">
                                                {{ $product->created_at }}
                                            </div>
                                        </td>
                                        <td class=" px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('admin.products.show', $product->slug) }}" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white text-center py-1 px-3 rounded">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product->slug) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white text-center py-1 px-3 rounded">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded" onclick="return confirm('Are you sure to remove this products ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center px-6 py-3 text-sm font-medium text-gray-500 whitespace-nowrap" colspan="7">
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
        <div class="mt-5">
            {{ $products->links() }}
        </div>
    </x-slot>
</x-app-layout>
