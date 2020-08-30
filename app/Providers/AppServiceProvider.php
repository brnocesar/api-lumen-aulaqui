<?php

namespace App\Providers;

use App\Models\Materia;
use App\Models\Professor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('validator')->extend('existeMateria', 'App\Validation\MateriaValidation@existeMateria');
        app('validator')->extend('pertenceAoProfessor', 'App\Validation\ProfessorValidation@pertenceAoProfessor');
        app('validator')->extend('acabarMesmoDia', 'App\Validation\AulaValidation@acabarMesmoDia');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
