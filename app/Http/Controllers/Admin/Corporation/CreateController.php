<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("admin.corporation.create");
    }
}
