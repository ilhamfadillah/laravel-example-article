<?php

namespace App\Observers;

use Illuminate\Support\Str;

class ModelUuid
{
    public function creating($model): void
    {
        if (empty($model->uuid)) {
            $model->uuid = Str::uuid();
        }
    }
}
