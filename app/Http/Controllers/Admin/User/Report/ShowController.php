<?php

namespace App\Http\Controllers\Admin\User\Report;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Report;

class ShowController extends Controller
{
    public function __invoke(Report $report): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $organizations = Organization::all();
        return view("admin.user.report.show", compact('report', 'organizations'));
    }
}
