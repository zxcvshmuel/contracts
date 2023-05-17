<?php

namespace App\Filament\Resources\EventsResource\RelationManagers;

use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Exception as ExceptionAlias;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractsRelationManager extends RelationManager {
    protected static string $relationship = 'Contracts';

    protected static ?string $recordTitleAttribute = 'חוזים';

    protected static ?string $navigationLabel = 'חוזים';

    protected static ?string $label = 'חוזה';

    protected static ?string $pluralModelLabel = 'חוזים';

    protected static ?string $breadcrumb = 'חוזים';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('events_id')->disabled(fn ($record) => !is_null($record))->default(function (RelationManager $livewire){
                        return $livewire->ownerRecord->id;
                    })->hidden(),
                    Forms\Components\TextInput::make('title')->disabled(fn ($record) => !is_null($record))->required()->label('כותרת'),
                    Forms\Components\TextInput::make('description')->disabled(fn ($record) => !is_null($record))->required()->label('תיאור'),
                    Forms\Components\Select::make('type')->disabled(fn ($record) => !is_null($record))->label('סוג מסמך')->options([
                        '1' => 'הצעת מחיר',
                        '2' => 'חוזה',
                    ])->required(),
                    TableRepeater::make('items')->disabled(fn ($record) => !is_null($record))->columns(4)->columnSpan('full')->columnWidths([
                        'count' => '100px',
                        'price' => '250px',
                    ])->label('פריטים')->schema([
                        Forms\Components\TextInput::make('name')->disabled(fn ($record) => !is_null($record))->required()->label('שם פריט')->required(),
                        Forms\Components\TextInput::make('count')->disabled(fn ($record) => !is_null($record))->minValue(0)->numeric()->label('כמות')->default(0),
                        Forms\Components\TextInput::make('price')->disabled(fn ($record) => !is_null($record))->minValue(0)->label('מחיר')->default(0),
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
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('כותרת'),
            Tables\Columns\TextColumn::make('description')->label('תיאור'),
            Tables\Columns\IconColumn::make('sent')->boolean()->label('נשלח'),
            Tables\Columns\IconColumn::make('opened')->boolean()->label('נצפה'),
            Tables\Columns\IconColumn::make('signed')->boolean()->label('נחתם'),
            Tables\Columns\IconColumn::make('signed_url')->boolean()->label('קישור')
                ->url(fn ($record) => \Storage::url('/') .$record->signed_url, true),
            Tables\Columns\TextColumn::make('created_at')->label('תאריך יצירה'),
            ])->filters([//
            ])->headerActions([
                Tables\Actions\CreateAction::make(),
                //                Tables\Actions\DeleteAction::make(),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('created_at', 'desc');
    }


    /**
     * @return Builder
     * @throws ExceptionAlias
     */
    /*protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }*/

}
