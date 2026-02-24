<?php


namespace App\Authentication\Application\CreateApiToken;


interface CreateApiTokenInterface
{
    /**
     * @param CreateApiTokenInput $input
     * @return CreateApiTokenResult
     */
    public function execute(CreateApiTokenInput $input): CreateApiTokenResult;
}
