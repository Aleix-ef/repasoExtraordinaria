<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadi;
use App\Http\Requests\EstadiRequest;

class EstadiController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadiosFutbolFemeni = Estadi::all();
        return view('estadis.index', compact('estadiosFutbolFemeni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equips.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Estadi $estadi)
    {
        return view('equips.edit', compact('estadi'));
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return redirect()->route('equips.index')->with('success', 'Equip esborrat correctament!');
    }

    public function store(EstadiRequest $request)
    {
        Estadi::create($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:equips,nom,' . $id,
            'estadi_id' => 'required|exists:estadis,id',
            'titols' => 'integer|min:0',
        ]);
        $estadi = Estadi::findOrFail($id);
        $estadi->update($validated);
        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament!');
    }
}
