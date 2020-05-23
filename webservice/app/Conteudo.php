<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    /**
     * The attributes that are mass assignable.
     * method create
     * @var array
     */
    protected $fillable = [
        'titulo', 'texto', 'imagem', 'link', 'data'
    ];

    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function curtidas()
    {
        // modelo, tabela, conteudo fk, user fk
        return $this->belongsToMany('App\User', 'curtidas', 'conteudo_id', 'user_id');
    }
    
}
