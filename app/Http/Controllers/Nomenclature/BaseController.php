<?php

namespace App\Http\Controllers\Nomenclature;

use App\Http\Controllers\Controller;
use App\Service\NomenclatureService;

class BaseController extends Controller
{
    public $service;

    private $fields;

    public function __construct(NomenclatureService $service)
    {
        $this->service = $service;
    }
}
