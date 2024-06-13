<?php

namespace App\Http\Controllers\Pages\Trash;

use App\Http\Controllers\Controller;

class BranchTrashController extends Controller
{
    public function __invoke()
    {
        return view('pages.trash.branch-trash');
    }
}
