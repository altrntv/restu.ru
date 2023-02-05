<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Organization;

class ShowController extends Controller
{
    public function __invoke($organization_slug, $report_slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $report = Organization::where('slug', $organization_slug)->firstorfail()->reports()->where('slug', $report_slug)->firstorfail();

//        if($report->id == 9)
//        {
//
//        }
        return view("report.show", [
            "report" => $report
        ]);
    }
}
