<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use LucasGiovanny\FilamentMultiselectTwoSides\Forms\Components\Fields\MultiselectTwoSides;

class ExpenseResource extends Resource {
    protected static ?string $model = Expense::class;

    protected static ?string $recordTitleAttribute = 'הוצאות';

    protected static ?string $navigationIcon = 'heroicon-o-trending-down';

    protected static ?string $navigationGroup = 'הוצאות';

    protected static ?string $navigationLabel = 'הוצאות';

    protected static ?string $label = 'הוצאה';

    protected static ?string $pluralModelLabel = 'הוצאות';

    protected static ?string $breadcrumb = 'הוצאות';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\Card::make()->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255)->label('כותרת'),
                        MultiselectTwoSides::make('category_id')->options(
                                \App\Models\Category::where('income', '0')
                                    ->where('user_id', auth()->user()->id)->pluck('name', 'id')
                            )->label('קטגוריה')->selectableLabel('קטגוריות')->selectedLabel('קטגוריה שנבחרה')->maxItems(
                                1
                            )->required(),
                        Forms\Components\TextInput::make('amount')->label('סכום')->numeric()->minValue(1)->required(),
                        Forms\Components\DatePicker::make('entry_date')->label('תאריך')
                            ->closeOnDateSelection()->required(),
                    ])->columns([
                        'sm' => 1,
                    ])->columnSpan(2),
                Forms\Components\Card::make()->schema([
                        Forms\Components\Placeholder::make('created_at')->label('נוצר בתאריך')->content(
                                fn(?Expense $record): string => $record ? $record->created_at->diffForHumans() : '-'
                            ),
                        Forms\Components\Placeholder::make('updated_at')->label('עודכן בתאריך')->content(
                                fn(?Expense $record): string => $record ? $record->updated_at->diffForHumans() : '-'
                            ),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->headerActions([
            FilamentExportHeaderAction::make('export')->label('יצוא'),
        ])->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable()->label('כותרת'),
            Tables\Columns\TextColumn::make('category.name')->searchable()->sortable()->label('קטגוריה'),
            Tables\Columns\TextColumn::make('amount')->searchable()->sortable()->label('סכום'),
            Tables\Columns\TextColumn::make('entry_date')->sortable()->label('Entry Date')->date()->label('תאריך'),
        ])->filters([//
            ]);
    }

    public static function getRelations(): array
    {
        return [//
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'category.name', 'amount'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->category)
        {
            $details['Category'] = $record->category->name;
        }

        return $details;
    }
}
