<?php

namespace App\Service;

use Carbon\Carbon;

class ReportService extends ApiServerService
{
    public function common($data, $report): array
    {
        try
        {
            $this->authorization($data, $report);
            $request = $this->requestOLAPv2($report);
            $this->logout();
        }
        catch (\Exception $exception)
        {
            abort(500, "Ошибка общей функции");
        }

        return $request;
    }

    public function commonTime($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++)
        {
            $request[$i] = $this->getCorrectTime($request[$i]);

            $request[$i]['Delivery.CustomerPhone'] = $this->phoneFormat($request[$i]['Delivery.CustomerPhone']);
            $request[$i]['Delivery.CookingTime'] = Carbon::parse($request[$i]['DishServicePrintTime'])->diffInMinutes($request[$i]['Delivery.CookingFinishTime']);

            if($request[$i]['Delivery.Delay'] == null) {
                $request[$i]['Delivery.Delay'] = Carbon::parse($request[$i]['Delivery.ActualTime'])->diffInMinutes($request[$i]['Delivery.ExpectedTime']) * -1;
            }
        }

        return $request;
    }

    public function preorderTime($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++)
        {
            $request[$i] = $this->getCorrectTime($request[$i]);

            $request[$i]['Delivery.CustomerPhone'] = $this->phoneFormat($request[$i]['Delivery.CustomerPhone']);
            $request[$i]['Delivery.CookingTime'] = Carbon::parse($request[$i]['DishServicePrintTime'])->diffInMinutes($request[$i]['Delivery.CookingFinishTime']);

            if($request[$i]['Delivery.Delay'] == null) {
                $request[$i]['Delivery.Delay'] = Carbon::parse($request[$i]['Delivery.ActualTime'])->diffInMinutes($request[$i]['Delivery.ExpectedTime']) * -1;
            }
        }

        return $request;
    }

    public function wages($data, $report): array
    {
        $this->authorization($data, $report);

        $requestSales = $this->requestOLAPv2($report, 'sales');
        $requestTransactions = $this->requestOLAPv2($report, 'transactions');
        $attendances = $this->attendances();
        $roles = $this->roles();
        $employees = $this->employees();

        $this->logout();

        $result = array();

        // Объединяем явки и сотрудников
        foreach($attendances as $a)
        {
            if(strtotime($a['dateFrom']) >= strtotime($this->data['from']))
                if($a['departmentName'] == 'ДИММИ ЯММИ' || $a['departmentName'] == 'ДИММИ ЯММИ СОЦ')
                {
                    foreach($employees as $e)
                    {
                        if($a['employeeId'] == $e['id'] && isset($a['dateTo']))
                        {
                            $result[] = [
                                'date' => Carbon::parse($a['dateFrom'])->format('d.m.Y'),
                                'department' => $a['departmentName'],
                                'employee' => $e['name'],
                                'role' => $a['roleId'],
                                'dateFrom' => Carbon::parse($a['dateFrom'])->format('d.m.Y H:i:s'),
                                'dateTo' => Carbon::parse($a['dateTo'])->format('d.m.Y H:i:s'),
                                'total' => Carbon::parse($a['dateTo'])->diff($a['dateFrom'])->format('%h'),
                                'revenue' => 0,
                                'salary' => 0,
                                'bonus' => 0,
                            ];
                        }
                    }
                }
        }

        // выручка
        for($i = 0; $i < count($result); $i++)
        {
            foreach($requestSales as $rS)
            {
                if($result[$i]['date'] == Carbon::parse($rS['OpenDate.Typed'])->format('d.m.Y') && $result[$i]['department'] == $rS['Department'])
                    $result[$i]['revenue'] = $rS['DishDiscountSumInt'];
            }
        }

        // должность
        for($i = 0; $i < count($result); $i++)
        {
            foreach($roles as $role)
            {
                if($result[$i]['role'] == $role['id'])
                    $result[$i]['role'] = $role['name'];
            }
        }

        // Зарплата
        for($i = 0; $i < count($result); $i++)
        {
            foreach($requestTransactions as $rT)
            {
                if($rT['TransactionType'] == 'EMPLOYEE_PAYMENT' || $rT['TransactionType'] == 'TARIFF_HOUR')
                {
                    if(
                        $rT['Counteragent.Name'] == $result[$i]['employee'] &&
                        Carbon::parse($rT['DateTime.DateTyped'])->format('d.m.Y') == $result[$i]['date'] &&
                        $rT['Department'] == $result[$i]['department']
                    )
                        $result[$i]['salary'] = $rT['Sum.Incoming'];
                }
                else if($rT['TransactionType'] == 'INCENTIVE_PAYMENT')
                {
                    if(
                        $rT['Counteragent.Name'] == $result[$i]['employee'] &&
                        Carbon::parse($rT['DateTime.DateTyped'])->format('d.m.Y') == $result[$i]['date'] &&
                        $rT['Department'] == $result[$i]['department']
                    )
                        $result[$i]['bonus'] = $rT['Sum.Incoming'];
                }
            }
        }

        // Группа
        for($i = 0; $i < count($result); $i++)
        {
            if(
                $result[$i]['role'] == 'Шеф' ||
                $result[$i]['role'] == 'Сушист' ||
                $result[$i]['role'] == 'Стажер сушист' ||
                $result[$i]['role'] == 'Заготовщик' ||
                $result[$i]['role'] == 'Упаковщик' ||
                $result[$i]['role'] == 'Стажер упаковщик'
            )
                $result[$i]['group'] = 'Повара';
            else if(
                $result[$i]['role'] == 'Менеджер'
            )
                $result[$i]['group'] = 'Менеджеры';
            else if(
                $result[$i]['role'] == 'Оператор' ||
                $result[$i]['role'] == 'Стажер оператор'
            )
                $result[$i]['group'] = 'Операторы';
            else if(
                $result[$i]['role'] == 'Курьер Основной' ||
                $result[$i]['role'] == 'Курьер Подработка'
            )
                $result[$i]['group'] = 'Курьеры';
            else
                $result[$i]['group'] = 'Другое';
        }

        return $result;
    }

    public function staleOrder($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++)
        {
            $request[$i] = $this->getCorrectTime($request[$i]);
            $request[$i]['Delivery.TimePreparationDelivery'] = Carbon::parse($request[$i]['Delivery.ActualTime'])->diffInMinutes($request[$i]['Delivery.CookingFinishTime']);

            if($request[$i]['Delivery.Delay'] == null) {
                $request[$i]['Delivery.Delay'] = Carbon::parse($request[$i]['Delivery.ActualTime'])->diffInMinutes($request[$i]['Delivery.ExpectedTime']) * -1;
            }

            $request[$i]['Delivery.CustomerPhone'] = $this->phoneFormat($request[$i]['Delivery.CustomerPhone']);
        }

        return $request;
    }

    public function costPrice($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++) {
            $request[$i] = $this->getCorrectTime($request[$i]);
            $request[$i]["DishSumInt"] = (float)$request[$i]["DishSumInt"];
            $request[$i]["DishDiscountSumInt"] = (float)$request[$i]["DishDiscountSumInt"];
            $request[$i]["ProductCostBase.ProductCost"] = (float)$request[$i]["ProductCostBase.ProductCost"];
            $request[$i]["ProductCostBase.Percent"] = (float)$request[$i]["ProductCostBase.Percent"] * 100;
            if((float)$request[$i]["DishSumInt"])
                $request[$i]["ProductCostBase.PercentWithoutDiscount"] = (float)$request[$i]["ProductCostBase.ProductCost"] / (float)$request[$i]["DishSumInt"] * 100;
        }

        return $request;
    }

    public function averageDeliveryTime($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++)
        {
            $request[$i] = $this->getCorrectTime($request[$i]);

            $request[$i]['Delivery.CookingTime'] = Carbon::parse($request[$i]['DishServicePrintTime'])->diffInMinutes($request[$i]['Delivery.CookingFinishTime']);
            $request[$i]['Delivery.DeliveryTime'] = Carbon::parse($request[$i]['Delivery.ActualTime'])->diffInMinutes($request[$i]['Delivery.SendTime']);
            $request[$i]['Delivery.OrderCompletionTime'] = Carbon::parse($request[$i]['OpenTime'])->diffInMinutes($request[$i]['Delivery.ActualTime']);
            $request[$i]['Delivery.ClientWaitingTime'] = Carbon::parse($request[$i]['DishServicePrintTime'])->diffInMinutes($request[$i]['Delivery.ActualTime']);
        }

        return $request;
    }

    public function unique($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++) {
            $request[$i]["Delivery.CustomerCreatedDateTyped"] = Carbon::parse($request[$i]['Delivery.CustomerCreatedDateTyped'])->format('d.m.Y');
            if($request[$i]["Delivery.CustomerCreatedDateTyped"] == $data['date']) {
                $request[$i]["Type"] = "Уникальный клиент";
            } else {
                $request[$i]["Type"] = "Повторный клиент";
            }
        }

        return $request;
    }

    public function executionTime($data, $report): array
    {
        $this->authorization($data, $report);
        $request = $this->requestOLAPv2($report);
        $this->logout();

        for($i = 0; $i < count($request); $i++)
        {
            $request[$i]["OpenDate.Typed"] = Carbon::parse($request[$i]['OpenDate.Typed'])->format('d.m.Y');
            $request[$i]["OpenTime"] = Carbon::parse($request[$i]['OpenTime'])->format('d.m.Y H:i:s');
            $request[$i]["CloseTime"] = Carbon::parse($request[$i]['CloseTime'])->format('d.m.Y H:i:s');
            $request[$i]['Delivery.CookingFinishTime'] = Carbon::parse($request[$i]['Delivery.CookingFinishTime'])->format('d.m.Y H:i:s');
            $request[$i]["Delivery.ActualTime"] = Carbon::parse($request[$i]['Delivery.ActualTime'])->format('d.m.Y H:i:s');
            $request[$i]["Delivery.SendTime"] = Carbon::parse($request[$i]['Delivery.SendTime'])->format('d.m.Y H:i:s');
            $request[$i]["DishServicePrintTime"] = Carbon::parse($request[$i]['DishServicePrintTime'])->format('d.m.Y H:i:s');


            //$request[$i]["Delivery.WayDuration"] = Carbon::parse($request[$i]['Delivery.WayDuration'])->format('%hч. %iм.');
            $request[$i]["ConfirmationTime"] = Carbon::parse($request[$i]['DishServicePrintTime'])->diff($request[$i]['OpenTime'])->format('%hч. %iм.');
            $request[$i]["CookingTime"] = Carbon::parse($request[$i]['DishServicePrintTime'])->diff($request[$i]['Delivery.CookingFinishTime'])->format('%hч. %iм.');
            $request[$i]["WaitingTime"] = Carbon::parse($request[$i]['Delivery.CookingFinishTime'])->diff($request[$i]['Delivery.SendTime'])->format('%hч. %iм.');
            $request[$i]["ServiceTime"] = Carbon::parse($request[$i]['OpenTime'])->diff($request[$i]['Delivery.ActualTime'])->format('%hч. %iм.');

            $request[$i]['Delivery.CustomerPhone'] = $this->phoneFormat($request[$i]['Delivery.CustomerPhone']);
        }

        return $request;
    }
}
