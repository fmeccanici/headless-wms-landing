<?php


namespace App\Authentication\Domain;


class Authentication extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'authentications';

    public function getId()
    {
        return $this->id;
    }
}
