<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6 px-4 sm:px-6 lg:px-8">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <table class="bg-white table-fixed mx-auto border-collapse border border-blue-800 w-3/4 text-center mt-10">
            <thead>
                <tr>
                    <th class="w-1/5 border border-blue-800">{{ __('ID') }}</th>
                    <th class="w-2/5 border border-blue-800">{{ __('Email') }}</th>
                    <th class="w-1/5 border border-blue-800">{{ __('State') }}</th>
                    <th class="w-1/5 border border-blue-800">{{ __('Handle') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border border-blue-800">{{ $user->id }}</td>
                        <td class="border border-blue-800">{{ $user->email }}</td>
                        <td class="border border-blue-800">
                            @if ($user->is_block === config('const.active'))
                                <p class="text-green-800 font-black rounded-b-full">{{ __('Active') }}</p>
                            @else
                            <p class="text-red-800 font-black rounded-b-full">{{ __('Block') }}</p>
                            @endif
                        </td>
                        <td class="border border-blue-800">
                            @if ($user->is_block === config('const.active'))
                            <form action="{{ route('admin.blockUser', ['user' => $user]) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-2 focus:outline-none">{{ __('Block') }}</button>
                            </form>
                            @else
                            <form action="{{ route('admin.activeUser', ['user' => $user]) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="bg-green-500 text-gray-100 rounded hover:bg-green-400 px-2 focus:outline-none">{{ __('Active') }}</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5 flex justify-center">
            {{ $users->links() }}
        </div>
    </x-slot>
</x-app-layout>
