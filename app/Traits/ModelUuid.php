<?php

namespace App\Traits;

use App\Observers\ModelUuid as ObserversModelUuid;

trait ModelUuid
{
    protected static function bootModelUuid(): void
    {
        static::observe(ObserversModelUuid::class);
    }
}
