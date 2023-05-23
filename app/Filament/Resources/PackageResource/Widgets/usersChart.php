<?php

namespace App\Filament\Resources\PackageResource\Widgets;


use App\Models\User;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class usersChart extends ApexChartWidget {
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'usersChart';

    protected static ?string $pollingInterval = null;


    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'מצב מנויים';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        // get all users by active_until date and show for each user how many days left on package
        $users = User::all();
        $amounts = [];
        $usersNames = [];
        $colors = [];

        foreach ($users as $key => $value)
        {

            $amounts[] = Carbon::parse($value->active_until)->diffInDays(Carbon::now());
            $usersNames[] = $value->name;
            if (Carbon::parse($value->active_until)->diffInDays(Carbon::now()) < 10)
            {
                $colors[] = '#ffa500';
            } else
            {
                if (Carbon::parse($value->active_until)->diffInDays(Carbon::now()) < 5)
                {
                    $colors[] = '#ff0000';
                } else
                {
                    $colors[] = '#008000';
                }
            }
        }

        $totalUsers = count($users);

        return [
            'chart'  => [
                'type'   => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'ימים שנשארו',
                    'data' => $amounts,
                ],
            ],
            'xaxis'  => [
                'categories' => $usersNames,
                'labels'     => [
                    'style' => [
                        'colors'     => 'black',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis'  => [
                'labels' => [
                    'style' => [
                        'colors'     => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => $colors,
        ];
    }
}
