<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Models\Events;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractsRelationManager extends RelationManager {
    protected static string $relationship = 'Contracts';


    protected static ?string $recordTitleAttribute = 'חוזים';

    protected static ?string $label = 'חוזה';

    protected static ?string $pluralModelLabel = 'חוזים';

    protected static ?string $breadcrumb = 'חוזה';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 2)->where('user_id', auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->label('צור מסמך')->schema([
                Forms\Components\Select::make('events_id')->disabled(fn($record) => !is_null($record))->options(
                    auth()->user()->events->pluck('title', 'id')
                )->preload()->required()->label('שם אירוע'),
                Forms\Components\TextInput::make('title')->disabled(fn($record) => !is_null($record))->required(
                )->label('כותרת'),
                Forms\Components\TextInput::make('description')->disabled(fn($record) => !is_null($record))->required(
                )->label('תיאור'),
                TableRepeater::make('items')->disabled(fn($record) => !is_null($record))->columns(4)->columnSpan(
                    'full'
                )->columnWidths([
                    'count' => '100px',
                    'price' => '250px',
                ])->label('פריטים')->schema([
                    Forms\Components\TextInput::make('name')->required()->label('שם פריט')->required(),
                    Forms\Components\TextInput::make('count')->minValue(0)->numeric()->label('כמות')->default(0),
                    Forms\Components\TextInput::make('price')->minValue(0)->label('מחיר')->default(0),
                ])->createItemButtonLabel('הוסף פריט'),
                Forms\Components\RichEditor::make('contracts_content')->disabled(fn($record) => !is_null($record)
                )->label('הערות נוספות')->disableAllToolbarButtons()->toolbarButtons([
                    'bold',
                    'bulletList',
                    'h2',
                    'h3',
                    'orderedList',
                    'redo',
                    'undo',
                ]),
            ]),
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['signed_url'] = \Storage::url($data['signed_url']);

        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table->headerActions([
            FilamentExportHeaderAction::make('export')->label('יצוא'),
        ])->columns([
            Tables\Columns\IconColumn::make('id')->falseIcon('heroicon-s-document')->trueIcon(
                    'heroicon-s-document'
                )->boolean()->label('הצג מסמך')->url(
                    fn($record) => '/contract/'.$record->id.'/view',
                    true
                ),
            Tables\Columns\IconColumn::make('signed_url')->falseIcon('heroicon-s-document')->trueIcon(
                    'heroicon-s-document'
                )->boolean()->label('הדפסה')->url(
                    fn($record) => '/contract/'.$record->id.'/pdf',
                    true
                ),
            Tables\Columns\TextColumn::make('event.customer.full_name')->label('שם לקוח')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('event.title')->label('אירוע')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->label('כותרת'),
            Tables\Columns\TextColumn::make('description')->label('תיאור')->limit(20),
            Tables\Columns\IconColumn::make('sent')->boolean()->label('נשלח'),
            Tables\Columns\IconColumn::make('opened')->boolean()->label('נצפה'),
            Tables\Columns\IconColumn::make('signed')->boolean()->label('נחתם'),

            Tables\Columns\TextColumn::make('created_at')->label('תאריך יצירה'),
        ])->filters([
                Tables\Filters\TrashedFilter::make(),
            ])->headerActions([
                Tables\Actions\CreateAction::make(),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ])->defaultSort('created_at', 'desc');
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['email'] = Events::find($data['event_id'])->customer->email;
        $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;

        return $data;
    }
}
