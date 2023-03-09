<?php


namespace App\Service;

use Carbon\Carbon;

class ApiServerService
{
    private object $client;
    public string $token;
    private string $server;
    public array $data;

    public function authorization($data, $report): bool
    {
        try
        {
            $this->client = new \GuzzleHttp\Client();
            $request = $this->client->get($report->organization->server . '/api/auth?login='. $report->organization->login .'&pass='. $report->organization->password);
            $this->token = $request->getBody()->getContents();
            $this->server = $report->organization->server;
            $this->data = $this->dateHandler($data);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка авторизации");
        }

        return true;
    }

    public function logout(): bool
    {
        try
        {
            $this->client->get($this->server . '/api/logout?key=' . $this->token);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка освобождения токена");
        }

        return true;
    }

    public function requestOLAPv2($report, $settings = ''): array
    {
        try
        {
            $json_request = json_decode($report['request_json'], true);
            if($settings == 'sales')
            {
                $json_request[$settings]['filters']['OpenDate.Typed']['from'] = $this->data['from'];
                $json_request[$settings]['filters']['OpenDate.Typed']['to'] = $this->data['to'];
                $request_olap = $this->client->post($this->server . '/api/v2/reports/olap?key=' . $this->token, [ 'json' => $json_request[$settings] ]);
            }
            else if($settings == 'transactions')
            {
                $json_request[$settings]['filters']['DateTime.DateTyped']['from'] = $this->data['from'];
                $json_request[$settings]['filters']['DateTime.DateTyped']['to'] = $this->data['to'];
                $request_olap = $this->client->post($this->server . '/api/v2/reports/olap?key=' . $this->token, [ 'json' => $json_request[$settings] ]);
            }
            else
            {
                if($json_request['reportType'] === 'SALES' || $json_request['reportType'] === 'DELIVERIES')
                {
                    $json_request['filters']['OpenDate.Typed']['from'] = $this->data['from'];
                    $json_request['filters']['OpenDate.Typed']['to'] = $this->data['to'];
                }
                else if($json_request['reportType'] === 'TRANSACTIONS')
                {
                    $json_request['filters']['DateTime.Typed']['from'] = $this->data['from'].'T00:01:00.000';
                    $json_request['filters']['DateTime.Typed']['to'] = $this->data['to'].'T23:59:00.000';
                }
                $request_olap = $this->client->post($this->server . '/api/v2/reports/olap?key=' . $this->token, [ 'json' => $json_request ]);
            }

            $result = json_decode($request_olap->getBody()->getContents(),true);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка запроса данных");
        }

        return $result['data'];
    }

    public function attendances(): array
    {
        try
        {
            $request_attendances = $this->client->get($this->server . '/api/employees/attendance?key=' . $this->token . '&from=' . $this->data['from'] . '&to='. $this->data['to'] . '&withPaymentDetails=false');
            $xml = simplexml_load_string($request_attendances->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
            $result = json_decode(json_encode($xml), true);

        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка получения явок");
        }

        return $result['attendance'];
    }

    public function roles(): array
    {
        try
        {
            $request_attendances = $this->client->get($this->server . '/api/employees/roles?key=' . $this->token);

            $xml = simplexml_load_string($request_attendances->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
            $result = json_decode(json_encode($xml), true);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка получения должностей");
        }

        return $result['role'];
    }

    public function employees(): array
    {
        try
        {
            $request_attendances = $this->client->get($this->server . '/api/employees?key=' . $this->token);

            $xml = simplexml_load_string($request_attendances->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
            $result = json_decode(json_encode($xml), true);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка получения должностей");
        }

        return $result['employee'];
    }

    public function events(): array
    {
        try
        {
            $request_attendances = $this->client->get($this->server . '/api/events?key=' . $this->token . '&from_time=' . $this->data['from'] . 'T00:00:00.000&to_time=' . $this->data['to'] . 'T23:59:59.999');
            $xml = simplexml_load_string($request_attendances->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
            $result = json_decode(json_encode($xml), true);
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка получения событий");
        }

        return $result['event'];
    }

    public function dateHandler($data)
    {
        try
        {
            if($data['type'] == 'month') {
                $data['from'] = Carbon::parse( '01.'. $data['date'])->format('Y-m-d');
                $data['to'] = Carbon::parse( $data['from'])->endOfMonth()->toDateString();
            } else if($data['type'] == 'range') {
                if(strlen($data['date']) > 10)
                {
                    $array = explode(' — ', $data['date']);
                    $data['from'] = Carbon::parse($array[0])->format('Y-m-d');
                    $data['to'] = Carbon::parse($array[1])->format('Y-m-d');
                }
                else
                {
                    $data['from'] = Carbon::parse($data['date'])->format('Y-m-d');
                    $data['to'] = Carbon::parse($data['date'])->format('Y-m-d');
                }
            } else if($data['type'] == 'day') {
                $data['from'] = Carbon::parse($data['date'])->format('Y-m-d');
                $data['to'] = Carbon::parse($data['date'])->format('Y-m-d');
            }

            return $data;
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка форматирования даты");
        }
    }

    public function getCorrectTime($data, $tz = 'Asia/Barnaul')
    {
        if(isset($data['OpenDate.Typed']))
        {
            $data['OpenDate.Typed'] = Carbon::parse($data['OpenDate.Typed'], $tz)->format('d.m.Y');
        }
        if(isset($data['DateTime.DateTyped']))
        {
            $data['DateTime.DateTyped'] = Carbon::parse($data['DateTime.DateTyped'], $tz)->format('d.m.Y');
        }
        if(isset($data['Delivery.ExpectedTime']))
        {
            $data['Delivery.ExpectedTime'] = Carbon::parse($data['Delivery.ExpectedTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['Delivery.ActualTime']))
        {
            $data['Delivery.ActualTime'] = Carbon::parse($data['Delivery.ActualTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['DishServicePrintTime']))
        {
            $data['DishServicePrintTime'] = Carbon::parse($data['DishServicePrintTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['Delivery.CookingFinishTime']))
        {
            $data['Delivery.CookingFinishTime'] = Carbon::parse($data['Delivery.CookingFinishTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['OpenTime']))
        {
            $data['OpenTime'] = Carbon::parse($data['OpenTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['CloseTime']))
        {
            $data['CloseTime'] = Carbon::parse($data['CloseTime'], $tz)->format('d.m.Y H:i:s');
        }
        if(isset($data['Delivery.SendTime']))
        {
            $data['Delivery.SendTime'] = Carbon::parse($data['Delivery.SendTime'], $tz)->format('d.m.Y H:i:s');
        }

        return $data;
    }

    public function phoneFormat($phone) {
        if($phone) {
            $phone = trim($phone);

            $res = preg_replace(
                array(
                    '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                    '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                    '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                    '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                    '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                    '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                ),
                array(
                    '+7 ($2) $3-$4-$5',
                    '+7 ($2) $3-$4-$5',
                    '+7 ($2) $3-$4-$5',
                    '+7 ($2) $3-$4-$5',
                    '+7 ($2) $3-$4',
                    '+7 ($2) $3-$4',
                ),
                $phone
            );
        } else {
            $res = 'none';
        }

        return $res;
    }
}
