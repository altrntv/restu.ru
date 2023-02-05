<?php

namespace App\Service;

class BizService
{
    const host = 'https://iiko.biz:9900';

    private string $login;
    private string $pass;
//    private string $organizationId;
//    private array $logs = array();
    private object $client;

    public function create($login, $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->client = new \GuzzleHttp\Client();
    }


    private function authorization(): string
    {
        $url = self::host.'/api/0/auth/access_token?user_id='.$this->login.'&user_secret='.$this->pass;

        $request = $this->client->get($url);

        return substr($request->getBody()->getContents(), 1, -1);
    }

    private function organizations(): string
    {
        $url = self::host.'/api/0/organization/list?access_token='.$this->authorization();

        $request = $this->client->get($url);
        $request = json_decode($request->getBody()->getContents(),true);

        return $request[0]['id'];
    }

    public function programs($report)
    {
        $url = self::host.'/api/0/organization/programs?access_token='.$this->authorization().'&organization='.$this->organizations();
        $request = $this->client->get($url);
        $programs = json_decode($request->getBody()->getContents(),true);

        $result = array();
        foreach ($programs as $program)
        {
            if($program['isActive'])
            {
                foreach ($program['marketingCampaigns'] as $marketingCampaign)
                {
                    if($marketingCampaign['isActive'])
                    {
                        array_push($result, [
                            'Программа' => $program['name'],
                            'Название' => $marketingCampaign['name'],
                            'Описание' => $marketingCampaign['description'],
                            'Срок действия' => $marketingCampaign['periodFrom'] . ' - ' . $marketingCampaign['periodTo']
                        ]);
                    }
                }
            }
        }

        //return $result;
        return [
            'request' => $result,
            'settings' => json_decode($report->report_json, JSON_UNESCAPED_UNICODE)
        ];
    }
}
