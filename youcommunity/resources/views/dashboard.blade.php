<x-app-layout>

    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 40px">
        <div style="display: flex; width: 90%; gap: 40px; margin-top: 30px">
            <div style="margin-top: 60px">
                <h1 style="font-size: 32px; font-weight: bold; color: #d1410c; margin-bottom: 20px;">
                    Effortless Event Planning
                </h1>
                <p style="margin-top: 60px; font-size: 18px; line-height: 1.6; color: #7b85cf; max-width: 600px; margin-left: auto; margin-right: auto;">
                    At <b style="color: #007BFF;">YouCommunity</b>, we make event planning simple and stress-free. From weddings to corporate events, we handle every detail with creativity and precision, bringing your vision to life. Experience seamless organization and unforgettable moments with our expert team.
                </p>
            </div>
            <video src="{{ asset('images/eventplaning.mp4') }}" style="width: 50%; height: 400px; border: #7b85cf solid; border-radius: 20px; opacity:0.65" autoplay loop muted ></video>
        </div>
        <img src="{{ asset('images/circle-cutout.png') }}" style=" height: 300px; margin-top: 120px; margin-bottom: 100px;">
    </div>

    <h1 style="justify-self: center; font-size: 30px; border-bottom: #d1410c solid">Latest Events</h1>
    {{-- events cards --}}
    <div style="display: flex; gap: 90px; justify-content: center; flex-wrap: wrap; padding: 20px; margin-top: 60px">
        @foreach ($events->take(3) as $event)

        <!-- Event Card  -->
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
                        <p style="font-size: 14px; color: #6b7280; margin-top: 8px;"><b>Location</b>: {{$event->location}}</p>
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
        <div>
            <a href="{{'events'}}" style="justify-self: center; font-size: 20px; color:white; background-color: #d1410c; border-radius: 5px; padding: 5px 15px; width: 170px; height: 10%">Discover More</a>
        </div>
    </div>

    @include('layouts.footer')

</x-app-layout>
