<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __invoke()
    {
        return view('pages.role');
    }
}
