{{-- resources/views/cities/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cities') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{-- Create Button --}}
        <div class="mb-4 flex justify-end">
            <a href="{{ route('cities.create') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                {{ __('Create City') }}
            </a>
        </div>

        {{-- Cities Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($cities as $city)
                <div class="bg-white shadow-lg ring-1 ring-gray-200 rounded p-6 flex flex-col justify-between transition duration-200 hover:shadow-2xl hover:ring-blue-400 hover:scale-105">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $city->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $city->description }}</p>
                    </div>
                    <div class="flex justify-end items-center space-x-4">
                        <a href="{{ route('cities.edit', $city) }}"
                           class="text-indigo-600 hover:text-indigo-900 font-medium">
                            {{ __('Edit') }}
                        </a>

                        {{-- Delete form with SweetAlert2 --}}
                        <form action="{{ route('cities.destroy', $city) }}"
                              method="POST"
                              data-swal-delete
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-2 text-center text-gray-500">No hay ciudades registradas.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $cities->links() }}
        </div>
    </div>
</x-app-layout>
