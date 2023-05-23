<?php

namespace App\Filament\Resources\PackageResource\Widgets;


use App\Models\Package;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class packagesChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'packageChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'משתמשים לפי חבילות';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        // get all active status packages and show the users for each package
        $packages = Package::all()->where('status', 'active');
        $amounts = [];
        $packagesNames = [];

        foreach ($packages as $key => $value) {
          $amounts[] = $value->users()->count();
          $packagesNames[] = $value->name;
        }



        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $amounts,
            'labels' => $packagesNames,
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
