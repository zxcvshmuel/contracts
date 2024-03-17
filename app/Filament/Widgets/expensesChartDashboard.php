<?php

namespace App\Filament\Resources\IncomeResource\Widgets;

use App\Models\Expense;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class expensesChartDashboard extends ApexChartWidget
{

    protected static ?int $sort = 30;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'expensesChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'רשימת הוצאות חודשית';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        // get all expenses for the current month, grouped by category and sum the amount of each category
        $expenses = Expense::whereMonth('entry_date', date('m'))
            ->whereYear('entry_date', date('Y'))->where('user_id', auth()->user()->id)
            ->get()->groupBy('category_id')->map(function ($item, $key) {
            return $item->sum('amount');
        });

        $amounts = [];
        $categories = [];

        if (!$expenses->isEmpty())
        {
            foreach ($expenses as $key => $value) {
                $amounts[] = $value;
                $categories[] = \App\Models\Category::find($key)->name;
            }
        }




        return [
            'chart' => [
                'type' => 'pie',
                'height' => 250,
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
