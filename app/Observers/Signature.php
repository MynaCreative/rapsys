<?php

namespace App\Observers;

/**
 *
 * SignatureObserver
 *
 * @author      Muhammad Cahya
 * @copyright   Copyright (c) 2022, Myna Creative.
 */
class Signature
{
    public function creating($model)
    {
        $model->created_by = $this->getId();
        $model->updated_by = $this->getId();
    }

    public function updating($model)
    {
        $model->updated_by = $this->getId();
    }

    public function getId()
    {
        return auth()->id() ?? app()->runningInConsole() ? 1 : null;
    }
}
