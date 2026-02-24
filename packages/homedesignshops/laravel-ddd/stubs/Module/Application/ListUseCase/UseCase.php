<?php


namespace App\Module\Application\UseCase;

class UseCase implements UseCaseInterface
{
    /**
     * UseCase constructor.
     */
    public function __construct()
    {

    }

    /**
     * @inheritDoc
     */
    public function execute(UseCaseInput $input): UseCaseResult
    {
        return new UseCaseResult();
    }
}
