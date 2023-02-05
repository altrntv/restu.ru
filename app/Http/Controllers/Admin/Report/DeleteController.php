<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;

class DeleteController extends Controller
{
    public function __invoke(Report $report): \Illuminate\Http\RedirectResponse
    {
        $report->delete();
        return redirect()->route('admin.user.report.index');
    }
}
