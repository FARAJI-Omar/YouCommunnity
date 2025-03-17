<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center items-center" style="width: 70%">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="border: 3px solid #7b85cfad; border-radius: 5px; width: 60%">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="mb-6">
                            <label for="title" class="block text-lg font-medium text-gray-700 text-center">Event Title</label>
                            <input type="text" name="title" id="title" value="{{ $event->title }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg" style="border: #d1410c 1px solid">
                        </div>
                        <div class="mb-6">
                            <label for="description" class="block text-lg font-medium text-gray-700 text-center">Event Description</label>
                            <textarea name="description" id="description" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg" style="border: #d1410c 1px solid">{{ $event->description }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label for="location" class="block text-lg font-medium text-gray-700 text-center">Event Location</label>
                            <input type="text" name="location" id="location" value="{{ $event->location }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg" style="border: #d1410c 1px solid">
                        </div>
                        <div class="mb-6">
                            <label for="event_date" class="block text-lg font-medium text-gray-700 text-center">Event Date</label>
                            <input type="datetime-local" name="event_date" id="event_date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg" style="border: #d1410c 1px solid">
                        </div>
                        <div class="mb-6">
                            <label for="max_participants" class="block text-lg font-medium text-gray-700 text-center">Max Participants</label>
                            <input type="number" name="max_participants" id="max_participants" value="{{ $event->max_participants }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" style="border: #d1410c 1px solid">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex text-white justify-center shadow-sm text-sm font-medium rounded-md" style="background-color: #7b85cfad; border-radius: 5px; padding: 10px 20px; font-size: 15px; font-weight: bold; border: #d1410c 1px solid">
                                Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
