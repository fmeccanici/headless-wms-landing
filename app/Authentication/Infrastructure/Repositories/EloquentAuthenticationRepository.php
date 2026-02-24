<?php


namespace App\Authentication\Infrastructure\Repositories;


use App\Authentication\Domain\Repositories\AuthenticationRepositoryInterface;
use App\Authentication\Domain\Authentication;

class EloquentAuthenticationRepository implements AuthenticationRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function findAuthentication(int $id): ?Authentication
    {
        return Authentication::find($id);
    }
}
