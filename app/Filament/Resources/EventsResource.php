<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Customer;
use App\Models\Events;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EventsResource extends Resource {
    protected static ?string $model = Events::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'אירועים';

    protected static ?string $label = 'אירוע';

    protected static ?string $pluralModelLabel = 'אירועים';

    protected static ?string $breadcrumb = 'אירועים';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('customer_id')->options(
                auth()->user()->customers()->get()->pluck('fullName', 'id')
            )->preload()->required()->label('שם לקוח'),
            Forms\Components\TextInput::make('city')->label('עיר')->maxLength(255),
            Forms\Components\TextInput::make('address')->label('רחוב ומספר בית')->maxLength(255),
            Forms\Components\TextInput::make('title')->label('כותרת')->required()->maxLength(255),
            Forms\Components\TextInput::make('content')->label('תוכן')->maxLength(255),
            Forms\Components\TextInput::make('type')->label('סוג')->maxLength(255),
            Forms\Components\DateTimePicker::make('date')->label('התחלה')->required()->closeOnDateSelection(),
            Forms\Components\DateTimePicker::make('end_at')->label('סיום')->required()->closeOnDateSelection(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                FilamentExportHeaderAction::make('export')->label('יצוא'),
            ])
            ->columns([
            Tables\Columns\TextColumn::make('customer.full_name')->label('שם לקוח')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('city')->label('עיר')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('address')->label('רחוב ומספר בית')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->label('כותרת')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('content')->label('תוכן')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type')->label('סוג')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('date')->label('תאריך')->sortable()->searchable()->dateTime(),
        ])->filters([
            Tables\Filters\TrashedFilter::make(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\ForceDeleteBulkAction::make(),
            Tables\Actions\RestoreBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContractsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvents::route('/create'),
            'edit'   => Pages\EditEvents::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $events = auth()->user()->events()->get();
        $customersId = [];

            foreach ($events as $event)
            {
                $customersId[] = $event->customer_id;
            }

            return parent::getEloquentQuery()->whereIn('customer_id', $customersId)->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);


    }

}
