<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $recordTitleAttribute = 'שם';

    protected static ?string $navigationLabel = 'קטגוריות';

    protected static ?string $label = 'קטגוריה';

    protected static ?string $pluralModelLabel = 'קטגוריות';

    protected static ?string $breadcrumb = 'קטגוריות';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Miscellaneous';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('שם')
                            ->required()
                            ->maxLength(255),
                        /*Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->inline(false)
                            ->required(),*/
                        Forms\Components\Radio::make('income')->label('סוג')->options([
                            1 => 'הכנסה',
                            0 => 'הוצאה',
                        ])->default([1])->required()
                    ])
                    ->columns([
                        'sm' => 1,
                    ])
                    ->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')->label('נוצר בתאריך')
                            ->content(fn (?Category $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('עודכן בתאריך')
                            ->content(fn (?Category $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                /*Tables\Columns\BooleanColumn::make('is_active')->label('Status')
                    ->searchable()
                    ->sortable(),*/
                Tables\Columns\IconColumn::make('income')->label('סוג')
                    ->boolean()->falseIcon('heroicon-o-trending-down')->trueIcon('heroicon-o-trending-up')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_active')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true))
            ])->headerActions([
                FilamentExportHeaderAction::make('export')->label('יצוא'),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
