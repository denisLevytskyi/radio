<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Вы должны принять.',
    'active_url'           => 'Поле is not a valid URL.',
    'after'                => 'Поле должно быть датой после :date.',
    'after_or_equal'       => 'Поле должно быть датой после или равной :date.',
    'alpha'                => 'Поле может содержать только буквы.',
    'alpha_dash'           => 'Поле может содержать только буквы, цифры, дефис и подчеркивание.',
    'alpha_num'            => 'Поле может содержать только буквы и цифры.',
    'array'                => 'Поле должно быть массивом.',
    'before'               => 'Поле должно быть датой перед :date.',
    'before_or_equal'      => 'Поле должно быть датой перед или равной :date.',
    'between' => [
        'numeric' => 'Поле должно быть между :min и :max.',
        'file'    => 'Размер должен быть от :min до :max килобайт.',
        'string'  => 'Длина должна быть от :min до :max символов.',
        'array'   => 'Поле должно содержать :min - :max элементов.',
    ],
    'boolean'              => 'Поле должно быть логической истинной или ложью.',
    'confirmed'            => 'Поле не совпадает с подтверждением.',
    'current_password'     => 'Неверный пароль',
    'date'                 => 'Поле не является датой.',
    'date_format'          => 'Поле не соответствует формату :format.',
    'different'            => 'Поля и :other должны различаться.',
    'digits'               => 'Длина цифрового поля должна быть :digits.',
    'digits_between'       => 'Длина цифрового поля должна быть между :min и :max.',
    'dimensions'           => 'Поле имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле имеет повторяющееся зачение.',
    'email'                => 'Поле должно быть действительным электронным адресом.',
    'exists'               => 'Выбранное значение для некорректно.',
    'file'                 => 'Поле должно быть файлом.',
    'filled'               => 'Поле обязательно для заполнения.',
    'image'                => 'Поле должно быть изображением.',
    'in'                   => 'Выбранное значение для ошибочно.',
    'in_array'             => 'Поле не существует в :other.',
    'integer'              => 'Поле должно быть целым числом.',
    'ip'                   => 'Поле должно быть действительным IP-адресом.',
    'ipv4'                 => 'Поле должно быть действительным IPv4-адресом.',
    'ipv6'                 => 'Поле должно быть действительным IPv6-адресом.',
    'json'                 => 'Поле должно быть валидной JSON строкой.',
    'max'                  => [
        'numeric' => 'Поле должно быть не больше :max.',
        'file'    => 'Поле должно быть не больше :max Килобайт.',
        'string'  => 'Поле должно быть не длиннее :max символов.',
        'array'   => 'Поле должно содержать не более :max элементов.',
    ],
    'mimes'                => 'Поле должно быть файлом одного из типов: :values.',
    'mimetypes'            => 'Поле должно быть файлом одного из типов: :values.',
    'min'                  => [
        'numeric' => 'Поле должно быть не менее :min.',
        'file'    => 'Поле должно быть не менее :min Килобайт.',
        'string'  => 'Поле должно быть не короче :min символов.',
        'array'   => 'Поле должно содержать не менее :min элементов.'
    ],
    'not_in'               => 'Выбранное значение для ошибочно.',
    'numeric'              => 'Поле должно быть числом.',
    'present'              => 'Поле должно присутствовать.',
    'regex'                => 'Поле имеет ошибочный формат.',
    'required'             => 'Поле обязательно для заполнения.',
    'required_if'          => 'Поле обязательно для заполнения, когда :other равно :value.',
    'required_unless'      => 'Поле обязательно для заполнения, когда :other не равно :values.',
    'required_with'        => 'Поле обязательно для заполнения, когда :values указано.',
    'required_with_all'    => 'Поле обязательно для заполнения, когда :values указаны.',
    'required_without'     => 'Поле обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле обязательно для заполнения, когда :values не указаны.',
    'same'                 => 'Значение должно совпадать с :other.',
    'size'                 => [
        'numeric' => 'Поле должно быть :size.',
        'file'    => 'Поле должно быть :size Килобайт.',
        'string'  => 'Поле должно быть длиной :size символов.',
        'array'   => 'Количество элементов в поле должно быть :size.'
    ],
    'string'               => 'Поде должно быть строкой.',
    'timezone'             => 'Поле должнобыть валидной временной зоной.',
    'unique'               => 'Такое значение поля уже существует.',
    'uploaded'             => 'Загрузка поля не удалась.',
    'url'                  => 'Поле имеет ошибочный формат.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
