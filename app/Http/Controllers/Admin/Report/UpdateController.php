<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\UpdateRequest;
use App\Models\Report;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Report $report): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $report->update($data);
        return back()
            ->with(['report' => $report])
            ->with('status', 'report-updated');
    }
}
