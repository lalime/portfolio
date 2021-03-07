<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 flex flex-col mb-1 sm:mb-0 justify-between w-full"">

            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif


            @if ($isOpen)
                @include('livewire.clients.create')
            @endif
            <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    All clients
                </h2>
                <div class="text-end">
                    <form class="flex w-full max-w-sm space-x-3">
                        <div class=" relative ">
                            <input type="text" id="&quot;form-subscribe-Filter"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="name" />
                        </div>
                        <button
                            class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200"
                            type="submit">
                            Filter
                        </button>
                    </form>
                </div>
                <button wire:click="create()"
                    class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200">Add
                    client</button>

            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col" 
                                    class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    No.
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    Brand
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    website
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    Created at
                                </th>
                                <th scope="col"
                                    class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if ($clients->total())
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $client->id }}</td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <a href="#" class="block relative">
                                                        <img alt="profil" src="{{ $client->logoUrl() }}"
                                                            class="mx-auto object-cover rounded-full h-10 w-10 " />
                                                    </a>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $client->title }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <a href="{{ $client->website }}">{{ $client->website }}</a>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $client->created_at->format('d/m/Y') }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <button wire:click="edit({{ $client->id }})"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            <button wire:click="delete({{ $client->id }})"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 text-center whitespace-no-wrap">
                                            No record found!
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="px-5 bg-white py-5 flex flex-col xs:flex-row items-center xs:justify-between">
                        <div class="flex items-center">{{ $clients->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
