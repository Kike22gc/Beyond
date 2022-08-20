<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederacionApp extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'st_federaciones';
    protected $primaryKey = 'federacion_id';

    protected bool $_isRoot = false;

    private ?Collection $_items = null;
}
