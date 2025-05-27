<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
                {{ __('Ciudadanos') }}
            </h2>
            <a href="{{ route('citizens.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
                Crear
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Formulario de búsqueda --}}
            <form action="{{ route('citizens.index') }}" method="GET" class="flex mb-4">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="Buscar por nombre de ciudadano o ciudad"
                       class="flex-1 px-4 py-2 border rounded-l-lg focus:outline-none"/>
                <button type="submit"
                        class="px-6 bg-gray-800 text-white rounded-r-lg hover:bg-gray-700">
                    Buscar
                </button>
            </form>

            {{-- Agrupación por ciudad --}}
            @forelse($cities as $city)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-100 to-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-700">{{ $city->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $city->citizens->count() }} ciudadanos</span>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">Nombre Completo</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">Edad</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($city->citizens as $citizen)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $citizen->getFullName() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $citizen->getAge() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                        <a href="{{ route('citizens.edit', $citizen) }}"
                                           class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-1.5 px-4 rounded-lg shadow transition">
                                            Editar
                                        </a>
                                        <form action="{{ route('citizens.destroy', $citizen) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('¿Eliminar {{ $citizen->getFullName() }}?')"
                                                    class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-1.5 px-4 rounded-lg shadow transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                        No hay ciudadanos en esta ciudad.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="text-center text-gray-500">No se encontraron ciudades ni ciudadanos.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>
