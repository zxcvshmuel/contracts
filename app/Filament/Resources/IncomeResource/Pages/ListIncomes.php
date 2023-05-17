<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use App\Filament\Resources\IncomeResource\Widgets\expensesChartDashboard;
use App\Filament\Resources\IncomeResource\Widgets\incomeChartDashboard;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;


    protected function getHeaderWidgets(): array
    {
        return [
            incomeChartDashboard::class,
            expensesChartDashboard::class,
        ];
    }
}
