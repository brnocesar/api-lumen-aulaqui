<?php

namespace App\Models;

class Materia extends ModelBasico
{
    protected $fillable   = ['nome'];
    protected $appends    = ['url', 'aulas', 'professores'];

    public static $rules = [
        'nome'       => 'required|max:60',
        'materia_id' => 'pertenceAoProfessor'
    ];


    public function professores()
    {
        return $this->belongsToMany(Professor::class);
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }


    public function getAulasAttribute(): array
    {
        return $this->mountUrlsArray("aulas");
    }

    public function getProfessoresAttribute(): array
    {
        return $this->mountUrlsArray("professores");
    }
}
