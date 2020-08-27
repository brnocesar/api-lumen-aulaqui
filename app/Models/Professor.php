<?php

namespace App\Models;

class Professor extends ModelBasico
{
    protected $table    = 'professores';
    protected $fillable = ['nome', 'avatar', 'whatsapp', 'short_bio', 'full_bio'];
    protected $appends  = ['url', 'aulas', 'materias'];

    public static $rules = [
        'nome'      => 'required|max:192',
        'avatar'    => 'max:255',
        'whatsapp'  => 'required|max:11|min:8',
        'short_bio' => 'required|max:144',
        'full_bio'  => 'required|max:255'
    ];


    public function materias()
    {
        return $this->belongsToMany(Materia::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }


    public function getAulasAttribute(): array
    {
        return $this->mountUrlsArray("aulas");
    }

    public function getMateriasAttribute(): array
    {
        return $this->mountUrlsArray("materias");
    }
}
