<x-app-layout>
    <x-slot name="slot">
        <div class="mt-14">
            <a href="{{ route('admin.categories.create') }}" class="bg-purple-500 hover:bg-purple-700 text-white text-center py-2 px-4 rounded">
                {{ __('New') }}
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
                                    <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('#') }}
                                    </th>
                                    <th scope="col" class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('Edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <div class="flex justify-center items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $num++ }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            <div class="flex justify-center items-center">
                                                <p class="px-4 py-1  text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">
                                                    {{ $category->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class=" px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('admin.categories.edit', $category->slug) }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white text-center py-1 px-3 rounded">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-center py-1 px-3 rounded" onclick="return confirm('Are you sure to remove this category ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            {{ $categories->links() }}
        </div>
    </x-slot>
</x-app-layout>
