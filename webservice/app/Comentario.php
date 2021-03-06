<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    /**
     * The attributes that are mass assignable.
     * method create
     * @var array
     */
    protected $fillable = [
        'conteudo_id', 'texto', 'imagem'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo', 'conteudo_id');
    }
}
