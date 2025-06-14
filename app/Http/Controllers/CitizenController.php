<?php

namespace App\Http\Controllers;
use App\Models\Citizen;
use App\Models\City;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->get('search');

    $cities = City::with(['citizens' => function($q) use ($search) {
        if ($search) {
            $q->where('first_name','like',"%{$search}%")
              ->orWhere('last_name','like',"%{$search}%");
        }
    }])
    ->when($search, fn($q) =>
        $q->where('name','like',"%{$search}%")
          ->orWhereHas('citizens', fn($q2) =>
              $q2->where('first_name','like',"%{$search}%")
                 ->orWhere('last_name','like',"%{$search}%")
          )
    )
    ->orderBy('name')
    ->get();

    return view('citizens.index', compact('cities','search'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        try {
            $cities = City::orderBy('name', 'asc')->get();
            return view('citizens.create', compact('cities'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar el formulario de creación: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'birth_date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:15',
        ]);
        try {
            Citizen::create($request->all());
            return redirect()->route('citizens.index')->with('success', 'Ciudadano creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el ciudadano: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $citizen = Citizen::findOrFail($id);
            return view('citizens.show', compact('citizen'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener el ciudadano: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $citizen = Citizen::findOrFail($id);
            $cities = City::orderBy('name', 'asc')->get();
            return view('citizens.edit', compact('citizen', 'cities'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar el formulario de edición: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'birth_date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:15',
        ]);
        try {
            $citizen = Citizen::findOrFail($id);
            $citizen->update($request->all());
            return redirect()->route('citizens.index')->with('success', 'Ciudadano actualizado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el ciudadano: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $citizen = Citizen::findOrFail($id);
            $citizen->delete();
            return redirect()->route('citizens.index')->with('success', 'Ciudadano eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el ciudadano: ' . $e->getMessage());
        }
    }
}
