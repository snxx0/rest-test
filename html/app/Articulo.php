<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Articulo extends Model 
{
    protected $table = 'articulos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'valor', 'imagen'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
