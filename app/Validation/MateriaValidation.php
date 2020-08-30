<?php

namespace App\Validation;

use App\Models\Materia;

class MateriaValidation
{
    /**
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     * @param  $validator
     * @return boolean
     */
    public function existeMateria($attribute, $value, $parameters, $validator)
    {
        return (bool) Materia::find($value);
    }
}
