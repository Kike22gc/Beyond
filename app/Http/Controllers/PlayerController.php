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

        $team = Players::create([
            'team_id' => $data['team_active'],
            'player_name' => $data['name'],
            'player_surname' => $data['surname'],
            'player_birthdate' => $data['birthdate'],
            'player_height' => $data['height'],
            'player_weight' => $data['weight'],
            'player_number' => $data['number'],
            'player_posicion' => $data['posicion'],
            'player_face_route' => $data['picture'],
            'player_alias' => $data['alias'],
        ]);

        return response()->json([
            'message' => 'Equipo Creado Correctamente',
            'status' => 'OK',
            'id' => $team->id
        ]);
    }

    public function editPlayer(Request $request)
    {
        $data = $request->all();
        error_log(print_r($data, true));

        $player = Players::where('player_id', $data['id'])->first();

        $player->player_name = $data['name'];
        $player->player_surname = $data['surname'];
        $player->player_birthdate = $data['birthdate'];
        $player->player_height = $data['height'];
        $player->player_weight = $data['weight'];
        $player->player_number = $data['number'];
        $player->player_posicion = $data['posicion'];
        $player->player_alias = $data['alias'];

        if($data['picture']){
            $player->player_face_route = $data['picture'];
        }

        $player->saveorfail();

        return response()->json([
            'message' => 'Jugador Editado Correctamente',
            'status' => 'OK',
            'id' => $data['id']
        ]);
    }

    public function uploadImagen(Request $request) 
    {
        $data = $request->all();

        //Obtener numero del equipo
        $team = $data['user'];

        //Obtener el nombre del fichero 
        $filename = $_FILES['file']['name'];
        
        //Crear la carpeta de imagenes de jugadores del equipo si no existe
        if (!file_exists("images/uploads/".$team)) {
            mkdir("images/uploads/".$team, 0777, true);
        }

        //Obtener la ubicacion añadiendo el fichero
        $location = "images/uploads/".$team."/".$filename;
        
        //Mover el fichero
        if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
            return response()->json([
                'message' => 'Imagen Subida Correctamente',
                'status' => 'OK',
                'path' => $location
            ]);
        } else { 
            return error()->json([
                'message' => 'Error al subir imagen',
                'status' => 'KO',
            ]); 
        }
    } 
}
