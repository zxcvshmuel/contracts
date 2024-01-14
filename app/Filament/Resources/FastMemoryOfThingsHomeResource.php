<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FastMemoryOfThingsHomeResource\Pages;
use App\Models\Contract;
use App\Models\FastMemoryOfThingsHome;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class FastMemoryOfThingsHomeResource extends Resource
{
    protected static ?string $model = FastMemoryOfThingsHomeResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'זכרון דברים השכרת דירה';

    protected static ?string $label = 'זכרון דברים להשכרת דירה';

    protected static ?string $pluralModelLabel = 'זכרון דברים להשכרת דירה';

    protected static ?string $breadcrumb = 'זכרון דברים להשכרת דירה';

    protected static ?string $slug = 'fast-memory-of-things-home-rental';

    public static function getEloquentQuery(): Builder
    {
        return Contract::query()->where('type', 6)
            ->where('user_id', auth()->user()->id);
    }

    public static function resolveRouteBindingQuery($query, $value, $field = null)
    {
        return $query->where('type', 6)
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
        return $form
            ->schema([
                Forms\Components\Card::make()->label('צור זכרון דברים לשכירות דירה')->schema([
                    Forms\Components\Select::make('events_id')->disabled(fn($record) => !is_null($record))->options(
                        auth()->user()->events->pluck('title', 'id')
                    )->preload()->label('שם אירוע - לא חובה')->reactive()->hidden(),

                    Forms\Components\TextInput::make('title')->disabled(fn(Closure $get) => $get('signed'))->required(
                    )->label('כותרת')->default('זיכרון דברים לשכירות דירה'),

                    Forms\Components\Fieldset::make('פרטי השוכר')->schema([
                        Forms\Components\TextInput::make('customer_name')->label('שם השוכר')->required()->hidden(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('customer_uid')->label('ת.ז')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('customer_phone')->label('טלפון')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('email')->email()->label('אימייל')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),

                        Forms\Components\TextInput::make('address')->label('כתובת')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                    ]),

                    // rented appartment
                    Forms\Components\Fieldset::make('פרטי המושכר')->schema([
                        Forms\Components\TextInput::make('rented_appartment_city')->label('עיר')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),

                        Forms\Components\TextInput::make('rented_appartment_street')->label('רחוב')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('rented_appartment_floor')->label('קומה')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('enterens_num')->label('כניסה')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('rented_appartment_num')->label('דירה')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('rented_appartment_price')->label('מחיר שכירות')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),
                        Forms\Components\TextInput::make('rented_appartment_rooms')->label('מספר חדרים')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        ),

                        Forms\Components\DatePicker::make('rented_appartment_to_be_signed')->label('תאריך מחויב לחתימה')->required()->disabled(
                            fn(Closure $get) => $get('signed')
                        )
                            ->minDate(now()->addDays(1)),
                    ]),
                ]),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index'  => Pages\ListFastMemoryOfThingsHomes::route('/'),
            'create' => Pages\CreateFastMemoryOfThingsHome::route('/create'),
            'edit'   => Pages\EditFastMemoryOfThingsHome::route('/{record}/edit'),
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
