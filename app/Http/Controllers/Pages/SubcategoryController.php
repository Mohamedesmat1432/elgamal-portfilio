<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    public function __invoke()
    {
        return view('pages.subcategory');
    }
}
