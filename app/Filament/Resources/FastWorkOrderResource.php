<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\FastWorkOrderResource\Pages;
use App\Filament\Resources\FastContractResource\RelationManagers;
use App\Models\Contract;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FastWorkOrderResource extends Resource {
    protected static ?string $model = FastWorkOrderResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'הזמנת עבודה';

    protected static ?string $label = 'הזמנת עבודה';

    protected static ?string $pluralModelLabel = ' הזמנת עבודה';

    protected static ?string $breadcrumb = 'הזמנת עבודה';

    protected static ?string $slug = 'fast-work-order';

    public static function getEloquentQuery(): Builder
    {
        return Contract::query()->where('type', Contract::TYPE['WORK_ORDER'])
            ->where('user_id', auth()->user()->id);
    }

    public static function resolveRouteBindingQuery($query, $value, $field = null)
    {
        return $query->where('type', Contract::TYPE['WORK_ORDER'])
            ->where('user_id', auth()->user()->id)
            ->whereKey($value);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->label('צור חוזה מהיר')->schema([
                Forms\Components\Select::make('events_id')->disabled(fn($record) => !is_null($record))->options(
                    auth()->user()->events->pluck('title', 'id')
                )->preload()->label('שם אירוע - לא חובה')->reactive()->hidden(),
                Forms\Components\TextInput::make('customer_name')->label('שם המזמין')->required()->hidden(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('customer_uid')->label('ת.ז')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('customer_phone')->label('טלפון')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('email')->email()->label('מייל לשליחה של המסמך')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
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
                    Forms\Components\TextInput::make('count')->minValue(1)->numeric()->label('כמות')->default(1),
                    Forms\Components\TextInput::make('price')->minValue(0)->numeric()->label('מחיר')->default(0)->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('tax', number_format($state * 0.17, 2, '.'));}),
                    Forms\Components\TextInput::make('tax')->default(0)->label('מע"מ')->disabled()->hidden(!auth()->user()->licensed_dealer),
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
            'index' => Pages\ListFastWorkOrders::route('/'),
            'create' => Pages\CreateFastWorkOrder::route('/create'),
            'edit' => Pages\EditFastWorkOrder::route('/{record}/edit'),
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
