<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;

class IndexController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if((int) \Auth::user()->role === \App\Models\User::ROLE_ADMIN) {
            $reports = Report::all()->sortBy([
                ['organization_id', 'asc'],
                ['name', 'asc'],
            ]);
        } else {
            $reports = Report::all()->where('organization_id', auth()->user()->organization_id);
        }

        return view("report.index", [
            "reports" => $reports
        ]);
    }
}
