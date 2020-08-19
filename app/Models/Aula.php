<?php

namespace App\Models;

class Aula extends ModelBasico
{
    protected $fillable = ['materia_id', 'professor_id', 'preco', 'inicio', 'fim', 'dia'];
    protected $hidden   = ['professor_id', 'materia_id'];
    protected $appends  = ['url', 'professor', 'materia'];


    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }


    public function getProfessorAttribute(): Professor
    {
        return $this->professor()->get()->makeHidden(['aulas', 'materias'])->first();
    }

    public function getMateriaAttribute(): Materia
    {
        return $this->materia()->get()->makeHidden(['aulas', 'professores'])->first();
    }
}
