<x-app-layout>
    <x-slot name="header">
        <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
              <div class="text-sm lg:flex-grow">
                <a href="{{ route('admin.manageUser') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-blue-800 mr-4">
                  {{ __('Users') }}
                </a>
              </div>
            </div>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
