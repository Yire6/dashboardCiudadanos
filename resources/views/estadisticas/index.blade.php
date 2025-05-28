{{-- resources/views/estadisticas/index.blade.php --}}

<x-app-layout>
    {{-- Slot para el header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas') }}
        </h2>
    </x-slot>

    {{-- Contenido principal --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Botón: Enviar reporte por correo --}}
            <form action="{{ route('estadisticas.report') }}" method="POST" class="mb-6">
                @csrf
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500 transition">
                    {{ __('Enviar reporte por correo') }}
                </button>
            </form>

                <div class="px-6 py-4">
                    <a href="{{ route('estadisticas.report.pdf') }}"
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">
                        {{ __('Descargar reporte PDF') }}
                    </a>
                </div>


            {{-- Cards de métricas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total de ciudades -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Total de ciudades</h3>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $totalCities }}</p>
                </div>

                <!-- Total de ciudadanos -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Total de ciudadanos</h3>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $totalCitizens }}</p>
                </div>

                <!-- Ciudad con más ciudadanos -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Ciudad con más ciudadanos</h3>
                    @php $top = $citiesWithCount->first(); @endphp
                    <p class="mt-4 text-4xl font-bold text-gray-900">
                        {{ $top?->name ?? 'N/A' }} ({{ $top?->citizens_count ?? 0 }})
                    </p>
                </div>
            </div>

            {{-- Tabla completa de conteos por ciudad --}}
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-700">Listado de ciudades</h3>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Ciudad</th>
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-600"># Ciudadanos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($citiesWithCount as $city)
                                <tr>
                                    <td class="border-t px-4 py-3 text-gray-800">{{ $city->name }}</td>
                                    <td class="border-t px-4 py-3 text-right text-gray-800">{{ $city->citizens_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
