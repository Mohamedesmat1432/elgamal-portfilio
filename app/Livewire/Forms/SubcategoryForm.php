<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use App\Models\Subcategory;
use App\Traits\HelperTrait;
use Illuminate\Support\Str;
use Livewire\Form;

class SubcategoryForm extends Form
{
    use HelperTrait;

    public ?Subcategory $subcategory;
    public ?int $id = null;
    public ?string $name = '';
    public ?string $slug = '';
    public ?int $category_id = null;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:subcategories,name,' . $this->id],
            'slug' => ['required', 'string', 'unique:subcategories,slug,' . $this->id],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
        ];
    }

    public function slugName()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function categories()
    {
        return Category::select('id', 'name')->get();
    }

    public function store()
    {
        $validated = $this->validate();
        Subcategory::withoutTrashed()->create($validated);
        $this->refresh();
    }

    public function setSubcategory($id)
    {
        $this->refresh();
        $this->subcategory = Subcategory::withoutTrashed()->findOrFail($id);
        $this->id = $this->subcategory->id;
        $this->name = $this->subcategory->name;
        $this->slug = $this->subcategory->slug;
        $this->category_id = $this->subcategory->category_id;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->subcategory->update($validated);
        $this->refresh();
    }

    public function delete($id)
    {
        $subcategory = Subcategory::withoutTrashed()->findOrFail($id);
        $subcategory->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $subcategories = Subcategory::withoutTrashed()->whereIn('id', $ids);
        $subcategories->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);
        $subcategory->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $subcategories = Subcategory::onlyTrashed()->whereIn('id', $ids);
        $subcategories->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);
        $subcategory->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $subcategories = Subcategory::onlyTrashed()->whereIn('id', $ids);
        $subcategories->forceDelete();
        $this->refresh();
    }
}
