<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Optionally include a Create Event link if needed -->
                    {{-- <a class="text-blue-500 hover:underline" href="{{ route('events.create') }}">Create Event</a> --}}
                    <!-- ...existing events loop... -->
                    @foreach ($events as $event)
                    <div class="mt-6 p-4 border-b">
                        <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                        <p>{{ $event->description }}</p>
                        <p class="text-sm text-gray-600">{{ $event->location }} | {{ $event->event_date }}</p>

                        <!-- RSVP Button Logic -->
                        @if ($event->rsvps()->where('user_id', auth()->id())->exists())
                        <form action="{{ route('rsvp.destroy', $event->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Cancel RSVP</button>
                        </form>
                        @else
                        <form action="{{ route('rsvp.store', $event->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">RSVP</button>
                        </form>
                        @endif

                        <!-- Display Comments -->
                        <h4 class="mt-4 font-semibold">Comments</h4>
                        @foreach ($event->comments as $comment)
                        <div class="pl-4 border-l mt-2">
                            <p>{{ $comment->content }} - <strong>{{ $comment->user->name }}</strong></p>
                            @if ($comment->user_id === auth()->id())
                            <!-- Delete Comment Form -->
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 px-2" style="color: red;">Delete</button>
                            </form>
                            @endif
                        </div>
                        @endforeach

                        <!-- Add New Comment Form -->
                        <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="content" placeholder="Add a comment" required class="w-full p-2 border rounded"></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded ">Submit Comment</button>
                        </form>
                    </div>
                    @endforeach
                    <div class="mt-6">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
