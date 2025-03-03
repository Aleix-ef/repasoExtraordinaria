<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jugadora;
use App\Http\Requests\JugadoraRequest;

class JugadoresController extends Controller
{

    protected $jugadores = [
        ['nom' => 'Alexia Putellas', 'equip' => 'Barça Femení', 'posicio' => 'Migcampista'],
        ['nom' => 'Esther González', 'equip' => 'Atlètic de Madrid', 'posicio' => 'Davantera'],
        ['nom' => 'Misa Rodríguez', 'equip' => 'Real Madrid Femení', 'posicio' => 'Portera'],
    ];
    public function index() {
        $jugadores = $this->jugadores;
        return view('jugadors.index', compact('jugadores'));
    }

    public function show(string $id) {
        $jugadores = $this->jugadores;
        $jugadora = $this->jugadores[$id];
        return view('jugadors.show', compact('jugadora'));
    }
    
    public function store(JugadoraRequest $request)
    {
        Jugadora::create($request->validated());
        return redirect()->route('jugadors')->with('success', 'Jugadora creada correctament.');
    }
}
