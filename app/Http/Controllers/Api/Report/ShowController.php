<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Requests\Api\ShowRequest;
use App\Models\Report;

class ShowController extends BaseController
{
    public function __invoke(ShowRequest $request, Report $report): array
    {
        $data = $request->validated();

        if($report->organization->name == 'Димми Ямми') {
            if($report->slug == 'common-time')
            {
                $request = $this->service->commonTime($data, $report);
            }
            else if($report->slug == 'preorder-time')
            {
                $request = $this->service->preorderTime($data, $report);
            }
            else if($report->slug == 'stale-order')
            {
                $request = $this->service->staleOrder($data, $report);
            }
            else if($report->slug == 'cost-price')
            {
                $request = $this->service->costPrice($data, $report);
            }
            else if($report->slug == 'average-delivery-time')
            {
                $request = $this->service->averageDeliveryTime($data, $report);
            }
            else if($report->slug == 'wages')
            {
                $request = $this->service->wages($data, $report);
            }
            else if($report->slug == 'unique-clients')
            {
                $request = $this->service->unique($data, $report);
            }
            else
            {
                $request = $this->service->common($data, $report);
            }
        }
//        else if($report->organization->name == 'Good Street Food')
//        {
//            if($report->slug == 'wages')
//            {
//                $request = $this->service->wages($data, $report);
//            }
//        }
        else if($report->organization->name == 'Лосось №1')
        {
            if($report->slug == 'execution-time')
            {
                $request = $this->service->executionTime($data, $report);
            }
        }

        return [
            'request' => $request,
            'settings' => json_decode($report->report_json, JSON_UNESCAPED_UNICODE)
        ];

    }
}
