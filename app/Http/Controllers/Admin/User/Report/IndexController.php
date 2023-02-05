<?php

namespace App\Http\Controllers\Admin\User\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;

class IndexController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $reports = Report::all();
        return view("admin.user.report.index", compact('reports'));
    }
}
