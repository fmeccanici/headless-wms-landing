<?php


namespace App\Inventory\Domain;


class Inventory extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'inventories';

    public function getId()
    {
        return $this->id;
    }
}
