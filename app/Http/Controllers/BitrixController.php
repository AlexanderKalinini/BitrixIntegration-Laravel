<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BitrixController extends Controller
{
    const PROFIT = 'UF_CRM_1704358226';

    public function showLeads()
    {
        $deals = Http::post(env("BITRIX24_DEAL_LIST"), [
            "select" => ['STAGE_ID', 'TYPE_ID', 'OPPORTUNITY', 'UF_*'],
        ]);
        $leads = Http::post(env("BITRIX24_LEAD_LIST"), [
            "select" => ['STAGE_ID', 'TYPE_ID', 'OPPORTUNITY', 'UF_*'],
        ]);

        $data = collect(array_merge($deals['result'], $leads['result']));


        $mappedData = $data->map(function ($item) {
            if (isset($item[BitrixController::PROFIT])) {
                $item = $item + ['PROFIT' => $item[BitrixController::PROFIT]];
                unset($item[BitrixController::PROFIT]);
                return $item;
            }
            return $item;
        });

        $groupedData =  $mappedData->groupBy(function (array $items) {
            foreach ($items as $key => $item) {
                if (str_starts_with($key, 'UF_')) {
                    return $item;
                }
            }
        })->all();

        return $groupedData;
    }
}