<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\PriceOffersResource\Pages;
use App\Filament\Resources\PriceOffersResource\RelationManagers;
use App\Models\Contract;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use Closure;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PriceOffersResource extends Resource {


    protected static ?string $model = PriceOffersResource::class;


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'הצעת מחיר מהירה';

    protected static ?string $label = 'הצעת מחיר מהירה';

    protected static ?string $pluralModelLabel = 'הצעות מחיר';

    protected static ?string $breadcrumb = 'הצעת מחיר מהירה';

    protected static ?string $slug = 'price-offers';

    public static function getEloquentQuery(): Builder
    {
        return Contract::query()->where('type', 1)
            ->where('user_id', auth()->user()->id)
            ->where('events_id', null);
    }

    public static function resolveRouteBindingQuery($query, $value, $field = null)
    {
        return $query->where('type', 1)
            ->where('user_id', auth()->user()->id)
            ->whereKey($value);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->label('צור מסמך הצעת מחיר')->schema([
                Forms\Components\Select::make('events_id')->disabled(fn($record) => !is_null($record))->options(
                    auth()->user()->events->pluck('title', 'id')
                )->preload()->label('שם אירוע - לא חובה')->reactive()->hidden(),
                Forms\Components\TextInput::make('customer_uid')->label('ת.ז לקוח')->required()->hidden(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('customer_name')->label('שם לקוח')
                    ->disabled(fn(Closure $get) => $get('signed'))->required(),
                Forms\Components\TextInput::make('customer_phone')
                    ->label('טלפון')->disabled(fn(Closure $get) => $get('signed'))->required(),
                Forms\Components\TextInput::make('email')->email()->label('מייל לשליחה של החוזה')
                    ->disabled(fn(Closure $get) => $get('signed'))->required(),
                Forms\Components\TextInput::make('title')->disabled(fn(Closure $get) => $get('signed'))->required(
                )->label('כותרת'),
                Forms\Components\TextInput::make('description')->disabled(fn(Closure $get) => $get('signed'))->required(
                )->label('תיאור'),
                TableRepeater::make('items')->disabled(fn(Closure $get) => $get('signed'))->columns(4)->columnSpan(
                    'full'
                )->columnWidths([
                    'count' => '100px',
                    'price' => '250px',
                ])->label('פריטים')->schema([
                    Forms\Components\TextInput::make('name')->required()->label('שם פריט')->required(),
                    Forms\Components\TextInput::make('count')->minValue(0)->numeric()->label('כמות')->default(0),
                    Forms\Components\TextInput::make('price')->minValue(0)->label('מחיר')->default(0),
                ])->createItemButtonLabel('הוסף פריט'),
                Forms\Components\RichEditor::make('contracts_content')->disabled(fn(Closure $get) => $get('signed')
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
            Tables\Columns\TextColumn::make('customer_name')->label('שם לקוח')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->label('כותרת'),
            Tables\Columns\TextColumn::make('description')->label('תיאור')->limit(20),
            Tables\Columns\IconColumn::make('sent')->boolean()->label('נשלח'),
            Tables\Columns\IconColumn::make('opened')->boolean()->label('נצפה'),
            Tables\Columns\IconColumn::make('signed')->boolean()->label('נחתם'),
            Tables\Columns\TextColumn::make('created_at')->label('תאריך יצירה'),
        ])->filters([
            Tables\Filters\TrashedFilter::make(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\ForceDeleteBulkAction::make(),
            Tables\Actions\RestoreBulkAction::make(),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [//
        ];
    }


    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPriceOffers::route('/'),
            'create' => Pages\CreatePriceOffers::route('/create'),
            'edit'   => Pages\EditPriceOffers::route('/{record}/edit'),
        ];
    }

    protected function getTableRecordUrlUsing(
    ): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return url(
            fn($record) => '/contract/'.$record->id.'/view',
            true
        );
    }
}
