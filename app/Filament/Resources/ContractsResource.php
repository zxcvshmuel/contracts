<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\ContractsResource\Pages;
use App\Filament\Resources\ContractsResource\RelationManagers;
use App\Models\Contract;
use App\Models\Events;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Savannabits\SignaturePad\Forms\Components\Fields\SignaturePad;
use function MongoDB\BSON\toJSON;

class ContractsResource extends Resource {
    protected static ?string $model = Contract::class;

    public function __construct(public Contract $contract)
    {

    }

//    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationLabel = 'חוזים';

    protected static ?string $label = 'חוזה';

    protected static ?string $pluralModelLabel = 'חוזים';

    protected static ?string $breadcrumb = 'חוזים';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                Forms\Components\Select::make('type')->disabled(fn($record) => !is_null($record))->label('סוג מסמך')->options([
                  '1' => 'הצעת מחיר',
                  '2' => 'חוזה',
                ])->required(),
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
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContracts::route('/create'),
            'edit' =>  Pages\EditContracts::route('/{record}/edit'),
        ];
    }

}
