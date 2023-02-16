<?php

namespace App\Http\Controllers\Menuboard;

use App\Models\Menuboard;

class IndexController extends BaseController
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if((int) \Auth::user()->role === \App\Models\User::ROLE_ADMIN) {
            $menuboards = Menuboard::all()->sortBy([
                ['id', 'asc'],
            ]);
        } else {
            $menuboards = Menuboard::all()->where('organization_id', auth()->user()->organization_id);
        }

        return view("menuboard.index", [
            "menuboards" => $menuboards
        ]);
    }
}
