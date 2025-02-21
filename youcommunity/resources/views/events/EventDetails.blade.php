<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
{{-- <div style=""> --}}
    <div style="background-color: white; width: 60%; margin: auto; font-family: 'Poppins', sans-serif; border: 1px solid #ddd; padding: 20px; border-radius: 10px;">

        <div>
            <img src="{{asset('images/event-image.jpg')}}" alt="">
        </div>

        <p style="color: #777; font-size: 12px; margin-bottom: 20px;">Created on: {{ \Carbon\Carbon::parse($event->created_at)->format('d-m-y') }}</p>
        <h2 style="margin-bottom: 20px; font-size: 60px; color: #5d66a6">{{$event->title}}</h2>
        <p style="margin-bottom: 20px;">
            <i class="fas fa-map-marker-alt" style="color: #555;"></i>
            {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}
        </p>
        <p style="margin-bottom: 30px;"><i class="fas fa-building" style="color: #555;"></i> Organized by: {{$event->user->name}}.</p>

        <h3 style="border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-bottom: 20px; font-size: 25px; font-weight: bold">About this Event</h3>
        <p style="color: #777; margin-bottom: 30px; word-wrap: break-word;">{{$event->description}}</p>

        <h3 style="border-bottom: 2px solid #ddd; padding-bottom: 5px; margin: 300px 0 0 ; font-size: 25px; font-weight: bold">Comments</h3>

        @foreach ($event->comments as $comment)
        <div class="pl-4 border-l mt-2">
            <div style="margin-top: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <p style="font-weight: bold; margin: 0; color: #777; font-size: 14px">{{ $comment->user->name }}</p>
                <p style="color: #777; font-size: 12px;">{{ \Carbon\Carbon::parse($event->event_date)->format('d-m H:i') }}</p>
                <p>{{ $comment->content }}
                {{-- delete --}}
                @if ($comment->user_id === auth()->id())
                <!-- Delete Comment Form -->
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 px-2" style="color: red;"><i class="fas fa-trash" style="color: #555; color: #b8b9c4;"></i> </button>
                </form>
                @endif
                </p>
            </div>
        </div>
        @endforeach
        <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" placeholder="Add a comment" required class="w-full p-2 border rounded"></textarea>
            <button type="submit" style="background-color: #7b85cfad; padding: 5px 10px; border-radius: 5px; font-size: 14px">Comment</button>
        </form>
    </div>

    <div>
        <p>nsdjndj</p>
    </div>
</div>
</x-app-layout>
@include('layouts.footer')



