<?php

namespace App\Http\Controllers\Api\Admin\Report;

use App\Http\Requests\Api\Admin\ShowRequest;
use App\Models\AdminReport;

class ShowController extends BaseController
{
    public function __invoke(ShowRequest $request, AdminReport $report)
    {
        $data = $request->validated();

        $request = $this->service->create($data['login'], $data['password']);



        dd($this->service->programs($report));

    }
}
