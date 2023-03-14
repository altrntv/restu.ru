<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;
use App\Models\Corporation;

class IndexController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $corporations = Corporation::all();

        return view("admin.corporation.index", compact('corporations'));
    }
}
