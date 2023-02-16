<?php

namespace App\Service;

use Carbon\Carbon;

class MenuboardService extends ApiTransportService
{
    public function common(): string
    {
        try
        {
            $this->authorization();
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка общей функции");
        }

        return $this->token;
    }
}
