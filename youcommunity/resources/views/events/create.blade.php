<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('events.store') }}" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="title" placeholder="Event Title" required>
                        </div>
                        <div>
                            <textarea name="description" placeholder="Event Description" required></textarea>
                        </div>
                        <div>
                            <input type="text" name="location" placeholder="Event Location" required>
                        </div>
                        <div>
                            <input type="datetime-local" name="event_date" required>
                        </div>
                        <div>
                            <input type="number" name="max_participants" placeholder="Max Participants" required>
                        </div>
                        <div>
                            <button type="submit">Create Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
