<?php
return [
    'date_format' => 'O campo :attribute não corresponde ao formato :format.',
    'exists'      => 'O valor passado não corresponde a nenhum professor registrado.',
    'in'          => 'O campo :attribute selecionado é inválido.',
    'integer'     => 'O campo :attribute deve ser um número inteiro.',
    'max' => [
        'numeric' => 'O campo :attribute não pode ser superior a :max.',
        'file'    => 'O campo :attribute não pode ser superior a :max kilobytes.',
        'string'  => 'O campo :attribute não pode ser superior a :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais do que :max itens.',
    ],
    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'required'    => 'O campo :attribute é obrigatório.',

    // custom validations
    'existe_materia'        => 'Matéria não existe.',
    'pertence_ao_professor' => 'Matéria não está associada ao Professor.',
    'acabar_mesmo_dia'      => 'O horário deve se encerrar no dia iniciado.',
];
