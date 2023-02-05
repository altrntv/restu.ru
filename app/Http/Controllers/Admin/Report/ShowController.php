<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\AdminReport;
use App\Models\Organization;
use App\Models\Report;

class ShowController extends Controller
{
    public function __invoke($report): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        $organizations = Organization::all();
//        return view("admin.report.show", compact('report', 'organizations'));
//
//        $report = Organization::where('slug', $organization_slug)->firstorfail()->reports()->where('slug', $report_slug)->firstorfail();
        $report = AdminReport::where('slug', $report)->firstorfail();

        if($report->id == 9)
        {

        }
        return view("admin.report.show", compact('report'));
    }
}
