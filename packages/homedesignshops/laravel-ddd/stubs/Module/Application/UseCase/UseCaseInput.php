<?php


namespace App\Module\Application\UseCase;

use HomeDesignShops\LaravelDdd\Support\Input;

final class UseCaseInput extends Input
{
    /**
     * @var array The PASVL validation rules
     */
    protected $rules = [];

    /**
     * UseCaseInput constructor.
     */
    public function __construct()
    {
        $this->validate([]);
    }

}
