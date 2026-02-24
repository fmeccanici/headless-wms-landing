<?php

namespace App\Warehouse\Domain\Exceptions;

use App\SharedKernel\DDD\DomainException;

class NonGuestOrderWithoutCustomerNumberException extends DomainException
{

}
