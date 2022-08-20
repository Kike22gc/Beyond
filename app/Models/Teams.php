<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'teams';
    protected $primaryKey = 'teams_id';

    const CREATED_AT = 'teams_created_at';
    const UPDATED_AT = 'teams_updated_at';

    protected $fillable = [
        'user_id',
        'federacion_id',
        'club_id',
    ];

    protected bool $_isRoot = false;

    private ?Collection $_items = null;
}
