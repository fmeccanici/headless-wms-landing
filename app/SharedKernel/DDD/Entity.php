<?php


namespace App\SharedKernel\DDD;

abstract class Entity
{
    protected int|string|null $id = null;
    protected int|string|null $parentId = null;

    public function identity(): int|string|null
    {
        return $this->id;
    }

    public function setIdentity(int|string $id): void
    {
        $this->id = $id;
        $this->cascadeSetIdentity($id);
    }

    public function parentIdentity(): int|string|null
    {
        return $this->parentId;
    }

    public function setParentIdentity(int|string $parentId): void
    {
        $this->parentId = $parentId;
    }

    abstract protected function cascadeSetIdentity(int|string $id): void;
}
