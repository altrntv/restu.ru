<?php

namespace App\Http\Controllers\Admin\User\Menuboard;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Nomenclature;

class CreateController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $organizations = Organization::all();
        $nomenclatures = Nomenclature::all()->where('organization_id', auth()->user()->organization_id);
        return view("admin.user.menuboard.create", compact('organizations', 'nomenclatures'));
    }
}
