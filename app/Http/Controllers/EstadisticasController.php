<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Citizen;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function index()
{
    // 1) Conteo total de ciudades
    $totalCities = City::count();

    // 2) Conteo total de ciudadanos
    $totalCitizens = Citizen::count();

    // 3) Listado de ciudades con su número de ciudadanos
    //    withCount() añade la columna 'citizens_count'
    //    orderBy() las ordena descendentemente
    $citiesWithCount = City::withCount('citizens')
                           ->orderBy('citizens_count', 'desc')
                           ->get();

    // 4) Devolver la vista pasando las variables
    return view('estadisticas.index', [
        'totalCities'    => $totalCities,
        'totalCitizens'  => $totalCitizens,
        'citiesWithCount'=> $citiesWithCount,
    ]);
}
}
