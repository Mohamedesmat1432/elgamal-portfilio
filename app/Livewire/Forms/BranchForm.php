<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use App\Traits\HelperTrait;
use Livewire\Form;

class BranchForm extends Form
{
    use HelperTrait;

    public ?Branch $branch;
    public ?int $id = null;
    public ?string $name = '';
    public ?string $address = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:branches,name,' . $this->id],
            'address' => ['required', 'string', 'max:500'],
        ];
    }

    public function store()
    {
        $validated = $this->validate();
        Branch::withoutTrashed()->create($validated);
        $this->refresh();
    }

    public function setBranch($id)
    {
        $this->refresh();
        $this->branch = Branch::withoutTrashed()->findOrFail($id);
        $this->id = $this->branch->id;
        $this->name = $this->branch->name;
        $this->address = $this->branch->address;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->branch->update($validated);
        $this->refresh();
    }

    public function delete($id)
    {
        $branch = Branch::withoutTrashed()->findOrFail($id);
        $branch->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $branches = Branch::withoutTrashed()->whereIn('id', $ids);
        $branches->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $branches = Branch::onlyTrashed()->whereIn('id', $ids);
        $branches->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $branches = Branch::onlyTrashed()->whereIn('id', $ids);
        $branches->forceDelete();
        $this->refresh();
    }
}
