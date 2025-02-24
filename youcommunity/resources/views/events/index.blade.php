<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <div style="display: flex; gap: 90px; justify-content: center; flex-wrap: wrap; padding: 20px; margin-top: 60px">
        @foreach ($events as $event)

        <!-- Event Card 1 -->
        <a href="{{ route('events.details', $event->id) }}">
            <div style="width: 400px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px #7b85cf90; overflow: hidden;">
                <!-- Div 1: Image of the event -->
                <div style="position: relative;">
                    <img src="{{ asset('images/event-image.jpg')}}" alt="Event Image" style="width: 100%; height: 150px; object-fit: cover;">
                </div>

                <!-- Div 2: Event details -->
                <div style="padding: 16px;">
                    <div style="display: flex;">
                        <!-- Left div: Date of event -->
                        <div style="width: 25%; text-align: center; background-color: #7b85cf50; padding: 8px; border-radius: 8px;">
                            <p style="font-size: 18px; font-weight: bold; color: #3b82f6;">{{ \Carbon\Carbon::parse($event->event_date)->format('M d') }}</p>
                            <p style="font-size: 14px; color: #6b7280;">{{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }}</p>
                        </div>

                        <!-- Right div: Event info -->
                        <div style="width: 75%; padding-left: 16px;">
                            <h3 style="font-size: 20px; font-weight: bold; color: #374151;">{{$event->title}}</h3>
                            <p style="font-size: 14px; color: #6b7280; margin-top: 8px;"><b>Location:</b> {{$event->location}}</p>
                            <p style="font-size: 14px; color: #6b7280; margin-top: 4px;"><b>Category:</b> {{$event->category}}</p>
                            <p style="font-size: 14px; color: #6b7280; margin-top: 4px;"><b>Max Participants:</b> {{$event->max_participants}}</p>
                            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Created by: {{$event->user->name}}</p>
                        </div>
                    </div>
                </div>

                <!-- Div 3: Participate button -->
                <div style="padding: 16px;">
                    @if($event->rsvps()->where('user_id', auth()->id())->exists())
                    <!-- Cancel Reservation Form -->
                    <form action="{{ route('rsvp.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style="width: 100%; color: #7b85cf; border: #d1410c solid 2px; padding: 12px; border-radius: 8px; cursor: pointer; font-size: 16px;">
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
            </div>
        </a>
        @endforeach
    </div>
    <div style="justify-self: center; margin: 30px 0 100px;">
        {{ $events->links() }}
    </div>
    @include('layouts.footer')

</x-app-layout>
