<?php

namespace App\Http\Controllers\Menuboard;

use App\Models\Nomenclature;
use App\Models\Organization;
use Carbon\Carbon;

class ShowController extends BaseController
{
    public function __invoke($organization_slug, $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $menuboard = Organization::where('slug', $organization_slug)->firstorfail()->menuboards()->where('id', $id)->firstorfail();

        $product = json_decode($menuboard['menu_json']);
        $nomenclature = Nomenclature::whereIn('id', $product->product)->get();

        $menuboard->active_at = Carbon::now('Asia/Barnaul');

        $menuboard->save();

        return view("menuboard.show", [
            "menuboard" => $menuboard,
            'nomenclature' => $nomenclature
        ]);
    }
}
