<?php

namespace App\Models;

class Aula extends ModelBasico
{
    protected $fillable = ['materia_id', 'professor_id', 'preco', 'inicio', 'fim', 'dia'];
    protected $hidden   = ['professor_id', 'materia_id'];
    protected $appends  = ['url', 'professor', 'materia'];

    public static $rules = [
        'materia_id'     => ['required', 'integer', 'existeMateria', 'pertenceAoProfessor'],
        'professor_id'   => ['required', 'integer', 'existeProfessor'],
        'preco'          => ['required', 'integer'],
        'inicio'         => ['required', 'date_format:H:i'],
        'fim'            => ['required', 'date_format:H:i', /* 'duracaoMinima', */ 'acabarMesmoDia'],
        'dia'            => ['required', 'integer', 'in:0,1,2,3,4,5,6']
    ];


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
