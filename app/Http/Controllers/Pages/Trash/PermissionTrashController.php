<?php

namespace App\Http\Controllers\Pages\Trash;

use App\Http\Controllers\Controller;

class PermissionTrashController extends Controller
{
    public function __invoke()
    {
        return view('pages.trash.permission-trash');
    }
}
