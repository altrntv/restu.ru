<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;
use App\Models\Corporation;

class ShowController extends Controller
{
    public function __invoke(Corporation $corporation): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("admin.corporation.show", compact('corporation'));
    }
}
