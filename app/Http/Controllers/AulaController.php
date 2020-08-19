<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Materia;
use App\Models\Professor;
use Illuminate\Http\Request;

class AulaController extends ControllerBasico
{
    public function __construct()
    {
        $this->entidade = Aula::class;
    }

    protected function search(Request $request)
    {
        $aulas = Aula::where('id', '>', 0)->orderBy('dia', 'asc')->orderBy('inicio', 'asc');

        if ($request->has('pag')) {
            $perPage = is_numeric($request->pag) ? $request->pag : '';
            return $aulas->paginate($perPage);
        }

        return $aulas->get();
    }

    public function indexByProfessor(int $professor_id)
    {
        $professor = Professor::find($professor_id);

        return is_null($professor) ? [] : $professor->aulas;
    }

    public function indexByMateria(int $materia_id)
    {
        $materia = Materia::find($materia_id);

        return is_null($materia) ? [] : $materia->aulas;
    }
}
