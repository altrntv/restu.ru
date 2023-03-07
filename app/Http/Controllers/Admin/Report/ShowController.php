<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\AdminReport;

class ShowController extends Controller
{
    public function __invoke($report): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $report = AdminReport::where('slug', $report)->firstorfail();

        return view("admin.report.show", compact('report'));
    }
}
