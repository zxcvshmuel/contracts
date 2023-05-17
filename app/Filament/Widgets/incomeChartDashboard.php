<?php

namespace App\Filament\Resources\IncomeResource\Widgets;

use App\Models\Income;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class incomeChartDashboard extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'incomeChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'רשימת הכנסות חודשית';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        // get all Income for the current month, grouped by category and sum the amount of each category
        $income = Income::whereMonth('entry_date', date('m'))
            ->whereYear('entry_date', date('Y'))->where('user_id', auth()->user()->id)
            ->get()->groupBy('category_id')->map(function ($item, $key) {
            return $item->sum('amount');
        });

        $amounts = [];
        $categories = [];

        if (!$income->isEmpty())
        {
            foreach ($income as $key => $value) {
                $amounts[] = $value;
                $categories[] = \App\Models\Category::find($key)->name;
            }
        }






        return [
            'chart' => [
                'type' => 'pie',
                'height' => 150,
            ],
            'series' => $amounts,
            'labels' => $categories,
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
