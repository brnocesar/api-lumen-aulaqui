<?php

namespace App\Validation;

use App\Models\Professor;

class ProfessorValidation
{
    /**
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     * @param  $validator
     * @return boolean
     */
    public function pertenceAoProfessor($attribute, $value, $parameters, $validator)
    {
        $professor = Professor::find($validator->getData()['professor_id']);

        return is_null($professor) ? false : $professor->materias()->find($value);
    }
}
