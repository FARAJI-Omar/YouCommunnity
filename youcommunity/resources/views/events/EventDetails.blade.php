<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
<div style="background-color: white; width: 60%; margin: auto; font-family: 'Poppins', sans-serif; border: 1px solid #ddd; padding: 20px; border-radius: 10px;">
   
    <div>
    <img src="{{asset('images/event-image.jpg')}}" alt="">
    </div>

    <p style="color: #777; font-size: 12px; margin-bottom: 20px;">Created on: {{ \Carbon\Carbon::parse($event->created_at)->format('d-m-y') }}</p>
    <h2 style="margin-bottom: 20px; font-size: 60px; color: #5d66a6">{{$event->title}}</h2>
    
    <!-- Div 3: Participate button -->
    <div style="margin: 16px 16px 50px 0; width: 30%">
        @if($event->rsvps()->where('user_id', auth()->id())->exists())
            <!-- Cancel Reservation Form -->
            <form action="{{ route('rsvp.destroy', $event->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button style="width: 100%; color: white; background-color: #d1410c; border: #7b85cf solid 2px; padding: 12px; border-radius: 8px; cursor: pointer; font-size: 16px;">
                    Cancel Reservation
                </button>
            </form>
            @else
            <!-- Book Now Form -->
            <form action="{{ route('rsvp.store', $event->id) }}" method="POST">
                @csrf
                <button style="width: 100%; background-color: #7b85cf; color: white; padding: 12px; border-radius: 8px; border: #d1410c solid 2px; cursor: pointer; font-size: 16px;">
                    Participate in this event
                </button>
            </form>
        @endif
    </div>
    <p style="margin-bottom: 20px;">
        <i class="fas fa-map-marker-alt" style="color: #555;"></i> 
        {{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d H:i') }}
    </p>
    <p style="margin-bottom: 30px;"><i class="fas fa-building" style="color: #555;"></i> Organized by:  <b>{{$event->user->name}}.</b></p>
    
    <h3 style="border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-bottom: 20px;">About this Event</h3>
    <p style="color: #444; margin-bottom: 30px;">Join us for the most anticipated tech conference of 2025. This three-day event will feature keynote speakers, workshops, and networking opportunities with industry leaders. Perfect for developers, designers, and tech enthusiasts.</p>
    
    <button id="toggleComments">
        <h3 style="border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-bottom: 20px; border-radius: 5px; padding:5px" onmouseover="this.style.backgroundColor='#7b85cf';" onmouseout="this.style.backgroundColor='';">Comments</h3>
    </button>
    <div id="comments">
        @foreach ($event->comments as $comment)
            <div class="pl-4 border-l mt-2">
                <div style="margin-top: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <p style="font-weight: bold; margin: 0;">{{ $comment->user->name }}</p>
                    <p>{{ $comment->content }}</p>
                    {{-- delete --}}
                    @if ($comment->user_id === auth()->id())
                        <!-- Delete Comment Form -->
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 px-2" style="color: red; background: none; border: none;">
                                <i class="fas fa-trash" style="color: red;"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
        <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" placeholder="Add a comment" required class="w-full p-2 border rounded"></textarea>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded" style="background-color: #7b85cf">Submit Comment</button>
        </form>
    </div>
</div>




    @include('layouts.footer')

</x-app-layout>


<script>
    const commentsDiv = document.getElementById('comments');
    commentsDiv.style.display = 'none';

    const toggleCommentsButton = document.getElementById('toggleComments');
    toggleCommentsButton.addEventListener('click', () => {
        if (commentsDiv.style.display === 'none') {
            commentsDiv.style.display = '';
        } else {
            commentsDiv.style.display = 'none';
        }
    });
</script>

