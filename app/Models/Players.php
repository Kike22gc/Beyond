<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'Players';
    protected $primaryKey = 'player_id';

    protected $fillable = [
        'team_id',
        'player_name',
        'player_surname',
        'player_alias',
        'player_birthdate',
        'player_height',
        'player_weight',
        'player_face_route',
        'player_number',
        'player_posicion',
    ];

    protected bool $_isRoot = false;

    private ?Collection $_items = null;
}
