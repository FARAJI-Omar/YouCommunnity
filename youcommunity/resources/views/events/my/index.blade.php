<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($events->isEmpty())
                    <p>No events found.</p>
                    @else
                    @foreach ($events as $event)
                    <div class="mt-6 p-4 border-b">
                        <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                        <p>{{ $event->description }}</p>
                        <p class="text-sm text-gray-600">{{ $event->location }} | {{ $event->event_date }}</p>
                        <!-- Delete Button updated to use custom route -->
                        <form action="{{ route('events.my.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
