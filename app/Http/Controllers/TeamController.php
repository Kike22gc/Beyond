<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Teams;

class TeamController extends BaseController
{
    public function getTeamsByUserID(Request $request)
    {
        $teams = Teams::where('user_id', $request->user()->id)->get();

        return($teams);

    }

    public function createTeam(Request $request)
    {
        $data = $request->all();

        $team = Teams::create([
            'user_id' => $request->user()->id,
            'federacion_id' => $data['federacion'],
            'club_id' => $data['club'],
        ]);

        return response()->json([
            'message' => 'Equipo Creado Correctamente',
            'status' => 'OK',
            'id' => $team->id
        ]);
    }
}
