<?php

namespace App\Traits;

trait HelperTrait
{
    public ?array $ids = [];
    public ?bool $select_all = false;

    public function refresh()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function selectAll($model)
    {
        $this->select_all ? ($this->ids = $model->pluck('id')->toArray()) : $this->refresh();
    }
}
