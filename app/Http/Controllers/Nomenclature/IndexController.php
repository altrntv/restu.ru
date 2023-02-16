<?php

namespace App\Http\Controllers\Nomenclature;

use App\Models\Nomenclature;

class IndexController extends BaseController
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if((int) \Auth::user()->role === \App\Models\User::ROLE_ADMIN) {
            $nomenclatures = Nomenclature::all()->sortBy([
                ['id', 'asc']
            ]);
        } else {
            $nomenclatures = Nomenclature::all()->where('organization_id', auth()->user()->organization_id);
        }

        return view("nomenclature.index", [
            "nomenclatures" => $nomenclatures
        ]);
    }
}
