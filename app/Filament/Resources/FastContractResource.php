<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\FastContractResource\Pages;
use App\Filament\Resources\FastContractResource\RelationManagers;
use App\Models\Contract;
use App\Models\FastContract;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FastContractResource extends Resource
{
    protected static ?string $model = FastContractResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'חוזה מהיר';

    protected static ?string $label = 'חוזה מהיר';

    protected static ?string $pluralModelLabel = ' חוזה מהיר';

    protected static ?string $breadcrumb = 'חוזה מהיר';

    public static function getEloquentQuery(): Builder
    {

        return Contract::query()->where('type', 4)
            ->where('user_id' , auth()->user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->label('צור חוזה מהיר')->schema([
                Forms\Components\Select::make('events_id')->disabled(fn ($record) => !is_null($record))->options(
                    auth()->user()->events->pluck('title', 'id')
                )->preload()->label('שם אירוע - לא חובה')->reactive()->hidden(),
                Forms\Components\TextInput::make('customer_name')->label('שם'),
                Forms\Components\TextInput::make('customer_uid')->label('ת.ז'),
                Forms\Components\TextInput::make('customer_phone')->label('טלפון'),
                Forms\Components\TextInput::make('email')->email()->label('מייל לשליחה של המסמך'),
                TableRepeater::make('items')->disabled(fn ($record) => !is_null($record))->columns(4)->columnSpan('full')->columnWidths([
                    'count' => '100px',
                    'price' => '250px',
                ])->label('פריטים')->schema([
                    Forms\Components\TextInput::make('name')->required()->label('שם פריט')->required(),
                    Forms\Components\TextInput::make('count')->minValue(0)->numeric()->label('כמות')->default(0),
                    Forms\Components\TextInput::make('price')->minValue(0)->label('מחיר')->default(0),
                ])->createItemButtonLabel('הוסף פריט'),
                Forms\Components\RichEditor::make('contracts_content')->disabled(fn ($record) => !is_null($record))
                    ->label('הערות נוספות')
                    ->disableAllToolbarButtons()
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'orderedList',
                        'redo',
                        'undo',
                    ]),
                Forms\Components\TextInput::make('title')->disabled(fn ($record) => !is_null($record))->required()->label('כותרת'),
                Forms\Components\TextInput::make('description')->disabled(fn ($record) => !is_null($record))->required()->label('תיאור'),
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
        return $table
            ->headerActions([
                FilamentExportHeaderAction::make('export')->label('יצוא'),
            ])
            ->columns([
                Tables\Columns\IconColumn::make('id')->falseIcon('heroicon-s-document')
                    ->trueIcon('heroicon-s-document')->boolean()->label('הצג מסמך')->url(
                        fn($record) => '/contract/'.$record->id.'/view',
                        true
                    ),
                Tables\Columns\IconColumn::make('signed_url')->falseIcon('heroicon-s-document')
                    ->trueIcon('heroicon-s-document')->boolean()->label('הדפסה')->url(
                        fn($record) => '/contract/'.$record->id.'/pdf',
                        true
                    ),
                Tables\Columns\TextColumn::make('created_at')->label('תאריך')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer_name')->label('שם לקוח')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('כותרת'),
                Tables\Columns\IconColumn::make('sent')->boolean()->label('נשלח')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('opened')->boolean()->label('נצפה')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('signed')->boolean()->label('נחתם')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('תאריך יצירה')->sortable()->searchable(),
            ])->filters([
                Tables\Filters\TrashedFilter::make(),
            ])->actions([
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListFastContracts::route('/'),
            'create' => Pages\CreateFastContract::route('/create'),
            'edit' => Pages\EditFastContract::route('/{record}/edit'),
        ];
    }

    protected function getTableRecordUrlUsing(): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return url(
            fn($record) => '/contract/'.$record->id.'/view',
            true);
    }
}
