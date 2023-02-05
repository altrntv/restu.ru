<?php

namespace App\Http\Controllers\Api\Admin\Report;

use App\Http\Controllers\Controller;
use App\Service\BizService;

class BaseController extends Controller
{
    public $service;

    private $fields;

    public function __construct(BizService $service)
    {
        $this->service = $service;
    }
}
