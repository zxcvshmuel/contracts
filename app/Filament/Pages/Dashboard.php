<?php

namespace App\Filament\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Pages\Dashboard as BasePage;
use App\Filament\Widgets\incomeChartDashboard;
use App\Filament\Widgets\expensesChartDashboard;

class Dashboard extends BasePage
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

    public function getTitle(): string{
        return 'ברוך הבא  ' . Auth::user()->name;
    }
}
