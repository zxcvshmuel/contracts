<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use App\Filament\Resources\IncomeResource\Widgets\expensesChartIncome;
use App\Filament\Resources\IncomeResource\Widgets\incomeChartIncome;
use Filament\Resources\Pages\ListRecords;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;


    protected function getHeaderWidgets(): array
    {
        return [
            incomeChartIncome::class,
            expensesChartIncome::class,
        ];
    }
}
