<?php

namespace App\Validation;

class AulaValidation
{
    /**
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     * @param  $validator
     * @return boolean
     */
    public function acabarMesmoDia($attribute, $value, $parameters, $validator)
    {
        return date_create_from_format('H:i', $value) > date_create_from_format('H:i', $validator->getData()['inicio']);
    }
}
