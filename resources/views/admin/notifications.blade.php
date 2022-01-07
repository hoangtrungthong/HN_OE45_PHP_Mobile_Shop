<x-app-layout>
    <x-slot name="slot">
        <div class="list-notification">
            @foreach ($data['notifications'] as $notify)
                <form action="{{ route('admin.notifications.update', $notify->id) }}" method="post">
                @csrf
                @method('PATCH')
                    <button type="submit" class="w-full p-3 mt-8 {{ $notify->read_at == null ? 'bg-blue-50' : 'bg-white' }} rounded flex items-center">
                        <div tabindex="0" aria-label="heart icon" role="img"
                            class="text-green-400 focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                            <i class="fas fa-donate"></i>
                        </div>
                        <div class="pl-3">
                            <p tabindex="0" class="focus:outline-none text-sm leading-none capitalize">
                                {{ $notify->data['content'] }}
                            </p>
                            <p tabindex="0" class="focus:outline-none float-left text-xs pt-1 text-gray-500">
                                {{ $notify->created_at->diffForHumans($data['now']) }}
                            </p>
                        </div>
                    </button>
                    @if ($notify->read_at == null)
                        <i class="fas fa-circle text-red-500 float-right mr-4 -mt-8" style="font-size: 6px"></i>
                    @endif
                </form>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>
