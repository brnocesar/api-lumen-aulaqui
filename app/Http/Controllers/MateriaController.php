<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Professor;

class MateriaController extends ControllerBasico
{
    public function __construct()
    {
        $this->entidade = Materia::class;
    }

    public function destroy($id)
    {
        $materia = Materia::find($id);

        if ( is_null($materia) ) {
            return response()->json(['erro' => 'Materia não encontrado'], 404);
        }

        $materia->professores()->detach();
        $materia->delete();

        return response()->json([], 204);
    }

    public function indexByProfessor(int $professor_id)
    {
        $professor = Professor::find($professor_id);

        return is_null($professor) ? [] : $professor->materias;
    }
}
