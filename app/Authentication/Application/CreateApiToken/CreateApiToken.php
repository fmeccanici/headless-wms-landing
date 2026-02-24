<?php


namespace App\Authentication\Application\CreateApiToken;

class CreateApiToken implements CreateApiTokenInterface
{
    /**
     * CreateApiToken constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function execute(CreateApiTokenInput $input): CreateApiTokenResult
    {
        $result = new CreateApiTokenResult();
        $result->id = 1;

        return $result;
    }
}
