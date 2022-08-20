<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Players;

class PlayerController extends BaseController
{
    public function getPlayersByTeamID(Request $request)
    {
        $data = $request->all();
        
        $players = Players::where('team_id', $data['team_active'])->get();

        return($players);

    }

    public function createPlayer(Request $request)
    {
        $data = $request->all();

        error_log(print_r($data, true));

        $team = Players::create([
            'team_id' => $data['team_active'],
            'player_name' => $data['name'],
            'player_surname' => $data['surname'],
            'player_birthdate' => $data['birthdate'],
        ]);

        return response()->json([
            'message' => 'Equipo Creado Correctamente',
            'status' => 'OK',
            'id' => $team->id
        ]);
    }
}
