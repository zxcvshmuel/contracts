<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\FastMemoryOfThingsCarResource\Pages;
use App\Models\Contract;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class FastMemoryOfThingsCarResource extends Resource
{
    protected static ?string $model = FastMemoryOfThingsCarResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'זכרון דברים לרכב';

    protected static ?string $label = 'זכרון דברים לרכב';

    protected static ?string $pluralModelLabel = ' זכרון דברים לרכב';

    protected static ?string $breadcrumb = 'זכרון דברים לרכב';

    protected static ?string $slug = 'fast-memory-of-things-car';

    public static function getEloquentQuery(): Builder
    {
        return Contract::query()->where('type', 5)
            ->where('user_id', auth()->user()->id);
    }

    public static function resolveRouteBindingQuery($query, $value, $field = null)
    {
        return $query->where('type', 5)
            ->where('user_id', auth()->user()->id)
            ->whereKey($value);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['signed_url'] = \Storage::url($data['signed_url']);

        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()->label('צור זכרון דברים לרכב')->schema([
                Forms\Components\Select::make('events_id')->disabled(fn($record) => !is_null($record))->options(
                    auth()->user()->events->pluck('title', 'id')
                )->preload()->label('שם אירוע - לא חובה')->reactive()->hidden(),
                Forms\Components\TextInput::make('title')->disabled(fn(Closure $get) => $get('signed'))->required(
                )->label('כותרת')->default('זיכרון דברים למכירת רכב'),
                Forms\Components\TextInput::make('customer_name')->label('שם הקונה')->required()->hidden(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('customer_uid')->label('ת.ז')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('customer_phone')->label('טלפון')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                // address
                Forms\Components\TextInput::make('address')->label('כתובת')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('email')->email()->label('מייל לשליחה של המסמך')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('location')->label('נחתם בעיר')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                // add fields for: car_distance, car_license_number
                Forms\Components\TextInput::make('car_distance')->label('קילומטרז\'')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('car_license_number')->label('מספר רכב')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),

                Forms\Components\TextInput::make('car_brand')->label('יצרן')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('car_model')->label('דגם')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('car_year')->label('שנה')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),

                Forms\Components\TextInput::make('car_color')->label('צבע')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('car_number')->label('מספר רישוי')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                // add fields for: מספר בעלים, מחיר הרכב
                Forms\Components\TextInput::make('owner_number')->label('יד')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                // היה או לא היה בחברת השכרה
                Select::make('was_in_rental_company')->options([
                    1 => 'כן',
                    0 => 'לא',
                ])->label('היה בחברת השכרה')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Select::make('was_in_accident')->options([
                    1 => 'כן',
                    0 => 'לא',
                ])->label('עבר תאונה משמעותית')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('car_price')->label('מחיר הרכב')->required()->disabled(
                    fn(Closure $get) => $get('signed')
                ),
                Forms\Components\TextInput::make('description')->disabled(fn(Closure $get) => $get('signed'))->required(
                )->label('תוכן הזכרון דברים')->hidden(),
                TableRepeater::make('items')->disabled(fn(Closure $get) => $get('signed'))->columns(4)->columnSpan(
                    'full'
                )->columnWidths([
                    'count' => '100px',
                    'price' => '250px',
                ])->label('פריטים')->schema([
                    Forms\Components\TextInput::make('name')->required()->label('שם פריט')->required(),
                    Forms\Components\TextInput::make('count')->minValue(1)->numeric()->label('כמות')->default(1),
                    Forms\Components\TextInput::make('price')->minValue(0)->label('מחיר')->default(0),
                ])->createItemButtonLabel('הוסף פריט')->hidden(),
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

    public static function table(Table $table): Table
    {
        return $table->headerActions([
            FilamentExportHeaderAction::make('export')->label('יצוא'),
        ])->columns([
            Tables\Columns\IconColumn::make('id')->falseIcon('heroicon-s-document')->trueIcon(
                'heroicon-s-document'
            )->boolean()->label('הצג מסמך')->url(
                fn($record) => '/contract/' . $record->id . '/view',
                true
            ),
            Tables\Columns\IconColumn::make('signed_url')->falseIcon('heroicon-s-document')->trueIcon(
                'heroicon-s-document'
            )->boolean()->label('הדפסה')->url(
                fn($record) => '/contract/' . $record->id . '/pdf',
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
        return [ //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFastMemoryOfThingsCar::route('/'),
            'create' => Pages\CreateFastMemoryOfThingsCar::route('/create'),
            'edit'   => Pages\EditFastMemoryOfThingsCar::route('/{record}/edit'),
        ];
    }

    protected function getTableRecordUrlUsing(
    ): string | \Illuminate\Contracts\Routing\UrlGenerator  | \Illuminate\Contracts\Foundation\Application
    {
        return url(
            fn($record) => '/contract/' . $record->id . '/view',
            true
        );
    }
}
