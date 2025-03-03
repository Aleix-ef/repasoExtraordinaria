<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Equip;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEquipRequest;

class EquipController extends Controller
{   
    use AuthorizesRequests;

    public function index() {
        $equips = Equip::all();
        return view('equips.index', compact('equips'));
    }

    public function show(Equip $equip) {
        return view('equips.show', compact('equip'));
    }

    public function create() {
        $this->authorize('create');
        $estadis = Estadi::all();
        return view('equips.create',compact('estadis'));
    }

    public function edit(Equip $equip) {
        $this->authorize('update', $equip);
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip','estadis'));
    }


    public function update(Request $request, Equip $equip)
    {
        $this->authorize('update', $equip);
        $validated = $request->validate([
            'nom' => 'required|unique:equips,nom,' . $equip->id,
            'titols' => 'integer|min:0',
            'estadi_id' => 'required|exists:estadis,id',
            'escut' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('escut')) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut); // Esborra l'escut antic
            }
            $path = $request->file('escut')->store('escuts', 'public');
            $validated['escut'] = $path;
        }

        $equip->update($validated);

        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament!');
    }

    public function destroy(Equip $equip)
    {
        $this->authorize('delete', $equip);
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        $equip->delete();
        return redirect()->route('equips.index')->with('success', 'Equip esborrat correctament!');
    }

    public function store(StoreEquipRequest $request)
{

    $validated = $request->validated(); // Obté les dades validades

    if ($request->hasFile('escut')) {
        $path = $request->file('escut')->store('escuts', 'public');
        $validated['escut'] = $path;
    }

    Equip::create($validated);

    return redirect()->route('equips.index')->with('success', 'Equip creat correctament!');
}


}
