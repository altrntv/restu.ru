<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NomenclatureService extends ApiTransportService
{
    public function update(): array
    {
        try
        {
            $this->authorization(Auth::user()->organization->transport_key);
            $request = $this->nomenclature(Auth::user()->organization->transport_organization);

        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка общей функции");
        }

        return $request;
    }
}
