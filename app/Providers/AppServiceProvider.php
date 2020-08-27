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
        /**
         * Custom Validator
         *
         * @param  string   $attribute      (field under validation)
         * @param  integer  $value          (value passed by request)
         * @param  array    $parameters     (value passed in the rule, "ruleName:{parameters}")
         * @param  object   $validator      (Validator instance)
         * @return bool
         */
        app('validator')->extend('existeMateria', function($attribute, $value, $parameters, $validator){
            return (bool) Materia::find($value);
        });
        app('validator')->replacer('existeMateria', function ($message, $attribute, $rule, $parameters) {
            return 'Matéria não existe.';
        });

        app('validator')->extend('pertenceAoProfessor', function($attribute, $value, $parameters, $validator){
            $professor = Professor::find($validator->getData()['professor_id']);
            return is_null($professor) ? false : $professor->materias()->find($value);
        });
        app('validator')->replacer('pertenceAoProfessor', function ($message, $attribute, $rule, $parameters) {
            return 'Matéria não está associada ao Professor.';
        });

        app('validator')->extend('existeProfessor', function($attribute, $value, $parameters, $validator){
            return (bool) Professor::find($value);
        });
        app('validator')->replacer('existeProfessor', function ($message, $attribute, $rule, $parameters) {
            return 'Professor não existe.';
        });

        // app('validator')->extend('duracaoMinima', function($attribute, $value, $parameters, $validator){
        //     return (bool) Professor::find($value);
        // });
        // app('validator')->replacer('duracaoMinima', function ($message, $attribute, $rule, $parameters) {
        //     return 'O intervalo mínimo é de 1 (uma) hora.';
        // });

        app('validator')->extend('acabarMesmoDia', function($attribute, $value, $parameters, $validator){
            return date_create_from_format('H:i', $value) > date_create_from_format('H:i', $validator->getData()['inicio']);
        });
        app('validator')->replacer('acabarMesmoDia', function ($message, $attribute, $rule, $parameters) {
            return 'O horário deve se encerrar no dia iniciado.';
        });
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
