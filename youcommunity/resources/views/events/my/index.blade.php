<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Events') }}
    </h2>
    </x-slot> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($events->isEmpty())
                    <p>No events found.</p>
                    @else
                    @foreach ($events as $event)
                    <div class="mt-6 p-4 border-b-2">
                        <h3 class="text-xl font-bold" style="font-size: 30px">{{ $event->title }}</h3>
                        <br>
                        <p style="word-wrap: break-word; color: gray">Description: {{ $event->description }}</p>
                        <br>
                        <p class="text-sm text-gray-600">Location: {{ $event->location }} | {{ $event->event_date }}</p>
                        <p class="text-sm text-gray-600">{{ $event->category }}</p>
                        <p class="text-sm text-gray-600">Participants: {{$event->rsvps->count()}}/{{$event->max_participants}}</p>
                        <div style="width: 8%; display:flex; justify-content: space-between; align-items: center">
                            <form action="{{ route('events.my.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #d1410c; padding: 5px 10px; border-radius: 5px; position: relative">
                                <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                            </form>
                            <!-- Edit Button -->
                            <div>
                                <a href="{{ route('events.edit', $event->id) }}" style="background-color: #7b85cf; padding: 7.5px 10px; border-radius: 5px; position: relative; top: 4px">
                                <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                </a>
                            </div>
                        </div>    
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div style="justify-self: center; margin: 30px 0 100px;">
        {{ $events->links() }}
    </div>
    @include('layouts.footer')
</x-app-layout>
