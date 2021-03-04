<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact messages.
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Todo</button>
            @if($isOpen)
            @include('livewire.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 text-left">Sender</th>
                        <th class="px-4 py-2 text-left">Subject</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($messages as $message)
                    <tr>
                        <td class="border px-4 py-2">{{ $message->id }}</td>
                        <td class="border px-4 py-2">{{ $message->name }}<br/><a class="text-gray-500" href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                        <td class="border px-4 py-2">{{ $message->subject}}</td>
                        <td class="border px-4 py-2">{{ optional($message->created_at)->format('d M Y')}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $message->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $message->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>