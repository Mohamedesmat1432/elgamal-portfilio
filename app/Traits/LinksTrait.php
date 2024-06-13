<?php

namespace App\Traits;
use App\Livewire\Actions\Logout;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Subcategory;
use App\Models\User;

trait LinksTrait
{
    public function logout(Logout $logout)
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function sidebarLinks()
    {
        return [
            [
                'name' => 'branches',
                'trans' => __('trans.branches'),
                'icon' => 'map',
                'permission' => 'branch-list',
                'count' => Branch::withoutTrashed()->count(),
            ],
            [
                'name' => 'permissions',
                'trans' => __('trans.permissions'),
                'icon' => 'lock-open',
                'permission' => 'permission-list',
                'count' => Permission::withoutTrashed()->count(),
            ],
            [
                'name' => 'roles',
                'trans' => __('trans.roles'),
                'icon' => 'shield-exclamation',
                'permission' => 'role-list',
                'count' => Role::withoutTrashed()->count(),
            ],
            [
                'name' => 'users',
                'trans' => __('trans.users'),
                'icon' => 'user',
                'permission' => 'user-list',
                'count' => User::withoutTrashed()->count(),
            ],
            [
                'name' => 'categories',
                'trans' => __('trans.categories'),
                'icon' => 'folder',
                'permission' => 'category-list',
                'count' => Category::withoutTrashed()->count(),
            ],
            [
                'name' => 'subcategories',
                'trans' => __('trans.subcategories'),
                'icon' => 'folder-open',
                'permission' => 'subcategory-list',
                'count' => Subcategory::withoutTrashed()->count(),
            ],
            [
                'name' => 'products',
                'trans' => __('trans.products'),
                'icon' => 'list-bullet',
                'permission' => 'product-list',
                'count' => Product::withoutTrashed()->count(),
            ],
        ];
    }

    public function sidebarTrashLinks()
    {
        return [
            [
                'name' => 'trash.branches',
                'trans' => __('trans.trash_branches'),
                'icon' => 'map',
                'permission' => 'branch-trash-list',
                'count' => Branch::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.permissions',
                'trans' => __('trans.trash_permissions'),
                'icon' => 'lock-open',
                'permission' => 'permission-trash-list',
                'count' => Permission::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.roles',
                'trans' => __('trans.trash_roles'),
                'icon' => 'shield-exclamation',
                'permission' => 'role-trash-list',
                'count' => Role::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.users',
                'trans' => __('trans.trash_users'),
                'icon' => 'user',
                'permission' => 'user-trash-list',
                'count' => User::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.categories',
                'trans' => __('trans.trash_categories'),
                'icon' => 'folder',
                'permission' => 'category-trash-list',
                'count' => Category::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.subcategories',
                'trans' => __('trans.trash_categories'),
                'icon' => 'folder-open',
                'permission' => 'subcategory-list',
                'count' => Subcategory::onlyTrashed()->count(),
            ],
            [
                'name' => 'trash.products',
                'trans' => __('trans.trash_products'),
                'icon' => 'list-bullet',
                'permission' => 'product-list',
                'count' => Product::onlyTrashed()->count(),
            ],
        ];
    }
}
