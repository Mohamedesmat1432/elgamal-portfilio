<?php

namespace App\Http\Controllers\Pages\Trash;

use App\Http\Controllers\Controller;

class RoleTrashController extends Controller
{
    public function __invoke()
    {
        return view('pages.trash.role-trash');
    }
}
