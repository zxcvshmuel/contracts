<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\expensesChartDashboard;
use App\Filament\Widgets\incomeChartDashboard;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected ?string $maxContentWidth = 'full';

    public function getHeaderWidgets(): array
    {
        return [

        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
