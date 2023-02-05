<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\StoreRequest;
use App\Models\Report;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        Report::firstOrCreate($data);
        return redirect()->route('admin.user.report.index');
    }
}
