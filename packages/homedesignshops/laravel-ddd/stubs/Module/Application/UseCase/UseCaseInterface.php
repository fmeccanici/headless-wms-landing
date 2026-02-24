<?php


namespace App\Module\Application\UseCase;


interface UseCaseInterface
{
    /**
     * @param UseCaseInput $input
     * @return UseCaseResult
     */
    public function execute(UseCaseInput $input): UseCaseResult;
}
