<?php


namespace App\Authentication\Application\CreateApiToken;

final class CreateApiTokenInput
{

    /**
     * @var int
     */
    protected $id;

    /**
     * CreateApiTokenInput constructor.
     * @param int $id
     * @throws \Exception
     */
    public function __construct(int $id)
    {
        // DO VALIDATIONS...
        if($id < 0) {
            throw new \Exception('Lower then 0');
        }

        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

}
