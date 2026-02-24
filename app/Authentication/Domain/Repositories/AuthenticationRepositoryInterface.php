<?php


namespace App\Authentication\Domain\Repositories;


use App\Authentication\Domain\Authentication;

interface AuthenticationRepositoryInterface
{
    /**
     * @param int $id
     * @return Authentication|null
     */
    public function findAuthentication(int $id): ?Authentication;
}
