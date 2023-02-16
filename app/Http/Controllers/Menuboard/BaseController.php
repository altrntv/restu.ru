<?php

namespace App\Http\Controllers\Menuboard;

use App\Http\Controllers\Controller;
use App\Service\MenuboardService;

class BaseController extends Controller
{
    public $service;

    private $fields;

    public function __construct(MenuboardService $service)
    {
        $this->service = $service;
    }
}
