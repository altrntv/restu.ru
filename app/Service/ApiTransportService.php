<?php


namespace App\Service;

use Carbon\Carbon;

class ApiTransportService
{
    private object $client;
    public string $token;
    private string $key;

    public function authorization($key) : string
    {
        try
        {
            $this->client = new \GuzzleHttp\Client();
            $request = $this->client->post('https://api-ru.iiko.services/api/1/access_token', [
                'json' => [ 'apiLogin' =>  $key]
            ]);
            $this->token = json_decode($request->getBody()->getContents())->token;
            //$this->token = $this->token->token;
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка авторизации API Transport");
        }

        return $this->token;
    }

    public function nomenclature($organization) : array
    {
        $request_nomenclature = $this->client->post('https://api-ru.iiko.services/api/1/nomenclature', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '. $this->token
            ],
            'json' => [
                'organizationId' => $organization,
                'startRevision' => 0,
            ]
        ]);

        return json_decode($request_nomenclature->getBody()->getContents(), true);
    }
}
