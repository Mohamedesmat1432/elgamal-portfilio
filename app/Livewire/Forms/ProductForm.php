<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\Subcategory;
use App\Traits\HelperTrait;
use Livewire\Form;

class ProductForm extends Form
{
    use HelperTrait;

    public ?Product $product;
    public ?int $id = null;
    public ?string $name = '';
    public ?string $description = '';
    public ?string $price = '';
    public ?int $subcategory_id = null;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:products,name,' . $this->id],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'string', 'max:500'],
            'subcategory_id' => ['required', 'numeric', 'exists:subcategories,id'],
        ];
    }

    public function subcategories()
    {
        return Subcategory::pluck('name', 'id')->toArray();
    }

    public function store()
    {
        $validated = $this->validate();
        Product::withoutTrashed()->create($validated);
        $this->refresh();
    }

    public function setProduct($id)
    {
        $this->refresh();
        $this->product = Product::withoutTrashed()->findOrFail($id);
        $this->id = $this->product->id;
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->subcategory_id = $this->product->subcategory_id;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->product->update($validated);
        $this->refresh();
    }

    public function delete($id)
    {
        $product = Product::withoutTrashed()->findOrFail($id);
        $product->delete();
        $this->refresh();
    }

    public function deleteAll($ids)
    {
        $products = Product::withoutTrashed()->whereIn('id', $ids);
        $products->delete();
        $this->refresh();
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        $this->refresh();
    }

    public function restoreAll($ids)
    {
        $products = Product::onlyTrashed()->whereIn('id', $ids);
        $products->restore();
        $this->refresh();
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        $this->refresh();
    }

    public function forceDeleteAll($ids)
    {
        $products = Product::onlyTrashed()->whereIn('id', $ids);
        $products->forceDelete();
        $this->refresh();
    }
}
