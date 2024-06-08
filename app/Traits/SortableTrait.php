<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortableTrait
{
    #[Url('')]
    public ?string $search = '';

    #[Url('')]
    public string $sort_by = 'id';

    #[Url('')]
    public bool $sort_dir = false;

    public ?int $page_count = 25;

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

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
