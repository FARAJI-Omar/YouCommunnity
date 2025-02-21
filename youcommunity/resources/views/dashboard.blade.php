<x-app-layout>


    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 40px">
        <img src="{{ asset('images/events.jpg') }}" style="width: 95%; height: 450px; border-radius: 5px; opacity:0.65">

        <img src="{{ asset('images/circle-cutout.png') }}" style=" height: 300px; margin-top: 50px; margin-bottom: 100px;">
    </div>

    <h1 style="justify-self: center; font-size: 30px; border-bottom: blue solid">Latest Events</h1>
    {{-- events cards --}}
    <div style="display: flex; gap: 90px; justify-content: center; flex-wrap: wrap; padding: 20px; margin-top: 60px">
        @foreach ($events->take(3) as $event)

        <!-- Event Card  -->
        <a href="{{ route('events.details', $event->id) }}">
            <div style="width: 400px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <!-- Div 1: Image of the event -->
            <div style="position: relative;">
                <img src="{{ asset('images/event-image.jpg')}}" alt="Event Image" style="width: 100%; height: 150px; object-fit: cover;">
            </div>

            <!-- Div 2: Event details -->
            <div style="padding: 16px;">
                <div style="display: flex;">
                    <!-- Left div: Date of event -->
                    <div style="width: 25%; text-align: center; background-color: #f3f4f6; padding: 8px; border-radius: 8px;">
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
                <button style="width: 100%; background-color: #3b82f6; color: white; padding: 12px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                    Participate
                </button>
            </div>
            </div>
        </a>
        @endforeach
        <a href="{{'events'}}" style="justify-self: center; font-size: 20px; color:white; background-color: #7b85cf; border-radius: 5px; padding: 5px 15px">Discover More</a>

    </div>

    @include('layouts.footer')

</x-app-layout>
