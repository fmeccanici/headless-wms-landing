<?php


namespace App\Module\Domain;


class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'module';

    public function getId()
    {
        return $this->id;
    }
}
