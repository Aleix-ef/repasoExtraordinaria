<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;
use App\Models\Partit;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class PartitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arbitres = User::where('role', 'arbitre')->get();

        if ($arbitres->isEmpty()) {
            throw new Exception('No hi ha cap àrbitre disponible.');
        }

        $equips = Equip::all();
        $numEquips = $equips->count();

        if ($numEquips % 2 !== 0 || $numEquips < 2) {
            throw new Exception('El nombre d\'equips ha de ser parell i almenys 2.');
        }

        $numJornades = $numEquips - 1; // Nombre de jornades per anada
        $partitsPerJornada = $numEquips / 2;
        $dataInicial = Carbon::create(2024, 9, 7); // Comença el 7 de setembre
        $dataLimitResultats = Carbon::create(2024, 12, 15); // Fins al 15 de desembre
        $arbitres = $arbitres->shuffle();

        // Generem el calendari d'anada
        $jornades = [];
        for ($jornada = 1; $jornada <= $numJornades; $jornada++) {
            $dataJornada = $dataInicial->copy()->addWeeks($jornada - 1); // Una jornada per setmana
            $jornades[$jornada] = []; // Guardem els partits d'aquesta jornada

            // Distribuïm els equips
            $equipsActuals = $equips->toArray();
            $localEquips = array_slice($equipsActuals, 0, $partitsPerJornada);
            $visitantEquips = array_reverse(array_slice($equipsActuals, $partitsPerJornada));

            for ($i = 0; $i < $partitsPerJornada; $i++) {
                $local = $localEquips[$i];
                $visitant = $visitantEquips[$i];

                // Alternança casa i fora
                if ($jornada % 2 === 0) { // Invertim en jornades parells
                    $temp = $local;
                    $local = $visitant;
                    $visitant = $temp;
                }

                $dataAleatoria = $dataJornada->copy()->addDays(rand(-2, 2)); // Data aleatòria dins del rang [-2, 2]
                $partit = Partit::create([
                    'local_id' => $local['id'],
                    'visitant_id' => $visitant['id'],
                    'estadi_id' => $local['estadi_id'],
                    'arbitre_id' => $arbitres->random()->id,
                    'jornada' => $jornada,
                    'data' => $dataAleatoria,
                    'gol_local' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) :null,
                    'gol_visitant' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) :null,
                ]);
                $jornades[$jornada][] = $partit;
            }

            // Rotació dels equips (round-robin)
            $equips->push($equips->splice(1, 1)[0]);
        }

        // Generem el calendari de tornada
        foreach ($jornades as $jornada => $partits) {
            $dataJornadaTornada = $dataInicial->copy()->addWeeks($numJornades + $jornada - 1); // Jornades de tornada després de les d'anada

            foreach ($partits as $partit) {
                $dataAleatoria = $dataJornadaTornada->copy()->addDays(rand(-2, 2)); // Data aleatòria dins del rang [-2, 2]
                Partit::create([
                    'local_id' => $partit->visitant_id, // Invertim local i visitant
                    'visitant_id' => $partit->local_id,
                    'estadi_id' => $partit->visitant_id ? Equip::find($partit->visitant_id)->estadi_id : null,
                    'arbitre_id' => $arbitres->random()->id,
                    'jornada' => $jornada + $numJornades, // Jornada de tornada
                    'data' => $dataAleatoria,
                    'gol_local' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                    'gol_visitant' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                ]);
            }
        }
    }
}