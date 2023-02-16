<?php

namespace App\Http\Controllers\Admin\User\Menuboard;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Menuboard;

class ShowController extends Controller
{
    public function __invoke(Menuboard $menuboard): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $organizations = Organization::all();
        return view("admin.user.menuboard.show", compact('menuboard', 'organizations'));
    }
}
