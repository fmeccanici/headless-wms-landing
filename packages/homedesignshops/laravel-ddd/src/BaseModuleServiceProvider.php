<?php

namespace HomeDesignShops\LaravelDdd;

use HomeDesignShops\LaravelDdd\Doctrine\RegistersDoctrine;
use Illuminate\Support\ServiceProvider;

abstract class BaseModuleServiceProvider extends ServiceProvider
{
    use RegistersDoctrine;
}