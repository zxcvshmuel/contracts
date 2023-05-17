<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CustomerResource extends Resource {
    protected static ?string $model = Customer::class;

    protected static ?string $navigationLabel = 'לקוחות';

    protected static ?string $label = 'לקוח';

    protected static ?string $pluralModelLabel = 'לקוחות';

    protected static ?string $breadcrumb = 'לקוחות';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\TextInput::make('first_name')->label('שם פרטי')->required()->maxLength(255),
                Forms\Components\TextInput::make('last_name')->label('שם משפחה')->required()->maxLength(255),
                Forms\Components\TextInput::make('uid')->label('ת.ז.')->required()->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('טלפון')->tel()->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->label('מייל')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('city')->label('עיר')->required()->maxLength(255),
                Forms\Components\TextInput::make('address')->label('רחוב ומספר בית')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                FilamentExportHeaderAction::make('export')->label('יצוא'),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->label('שם פרטי')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('last_name')->label('שם משפחה')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('uid')->label('ת.ז.')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('טלפון')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('מייל')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('city')->label('עיר')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('address')->label('רחוב ומספר בית')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('תאריך הקמה')->sortable()->searchable()->dateTime(
                    ),
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
            RelationManagers\EventsRelationManager::class,
            RelationManagers\ContractsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
            return parent::getEloquentQuery()->where('creator_id', auth()->id())->withoutGlobalScopes([
                SoftDeletingScope::class]);

    }
}
