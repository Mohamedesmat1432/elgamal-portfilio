<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait WithSortable
{
    #[Url('')]
    public ?string $sort_by = 'id';

    #[Url('')]
    public ?bool $sort_dir = false;

    public function sortBy($field)
    {
        if ($field == $this->sort_by) {
            $this->sort_dir = !$this->sort_dir;
        }

        $this->sort_by = $field;
    }

    public function sortDir()
    {
        return $this->sort_dir ? 'ASC' : 'DESC';
    }
}
