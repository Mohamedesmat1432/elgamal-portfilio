<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use App\Traits\HelperTrait;
use Livewire\Form;
use Illuminate\Support\Str;

class CategoryForm extends Form
{
    use HelperTrait;

    public ?Category $category;
    public ?int $id = null;
    public ?string $name = '';
    public ?string $slug = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:categories,name,' . $this->id],
            'slug' => ['required', 'string', 'unique:categories,slug,' . $this->id],
        ];
    }

    public function slugName()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function store()
    {
        $validated = $this->validate();
        Category::withoutTrashed()->create($validated);
        $this->refresh();
    }

    public function setCategory($id)
    {
        $this->refresh();
        $this->category = Category::withoutTrashed()->findOrFail($id);
        $this->id = $this->category->id;
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->category->update($validated);
        $this->refresh();
    }

    public function delete($id)
    {
        $category = Category::withoutTrashed()->findOrFail($id);
        $category->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $categorys = Category::withoutTrashed()->whereIn('id', $ids);
        $categorys->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $categorys = Category::onlyTrashed()->whereIn('id', $ids);
        $categorys->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $categorys = Category::onlyTrashed()->whereIn('id', $ids);
        $categorys->forceDelete();
        $this->refresh();
    }
}
