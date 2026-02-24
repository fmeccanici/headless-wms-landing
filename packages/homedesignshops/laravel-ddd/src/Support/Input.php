<?php

namespace HomeDesignShops\LaravelDdd\Support;

use PASVL\Validation\ValidatorBuilder;

abstract class Input
{
    /**
     * @var array The PASVL validation rules
     */
    protected $rules = [];

    /**
     * The data in array format to validate.
     *
     * @param array $data
     * @return void
     */
    protected function validate(array $data)
    {
        ValidatorBuilder::forArray($this->rules)
            ->build()
            ->validate($data);
    }
}