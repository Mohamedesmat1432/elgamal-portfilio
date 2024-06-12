<?php

namespace App\Http\Controllers\Pages\Trash;

use App\Http\Controllers\Controller;

class SubcategoryTrashController extends Controller
{
    public function __invoke()
    {
        return view('pages.trash.subcategory-trash');
    }
}
