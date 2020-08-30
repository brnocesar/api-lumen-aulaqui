<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerBasico extends Controller
{
    protected $entidade;

    public function index(Request $request)
    {
        return response()->json($this->search($request), 200);
    }

    protected function search(Request $request)
    {
        $materias = $this->entidade::where('id', '>', 0)->orderBy('nome', 'asc');

        if ($request->has('pag')) {
            $perPage = is_numeric($request->pag) ? $request->pag : '';
            return $materias->paginate( $perPage );
        }

        return $materias->get();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->entidade::$rules);

        return response()->json($this->entidade::create($request->all()), 200);
    }

    public function show($id)
    {
        $recurso = $this->entidade::find($id);

        return response()->json(
            $recurso,
            is_null($recurso) ? 404 : 200
        );
    }

    public function update($id, Request $request)
    {
        $this->validate($request, $this->entidade::$rules);

        $recurso = $this->entidade::find($id);
        if ( is_null($recurso) ) {
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        $recurso->update($request->all());

        return response()->json($recurso , 200);
    }

    public function destroy($id)
    {
        $recurso = $this->entidade::destroy($id);

        return response()->json(
            [],
            $recurso == 0 ? 404 : 204
        );
    }
}
