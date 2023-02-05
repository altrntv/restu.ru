<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Service\ReportService;

class BaseController extends Controller
{
    public $service;

    private $fields;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }
}
