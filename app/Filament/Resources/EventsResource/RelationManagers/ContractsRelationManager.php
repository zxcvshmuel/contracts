<?php

namespace App\Filament\Resources\EventsResource\RelationManagers;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Models\Contract;
use App\Models\Events;
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
        Forms\Components\TextInput::make('events_id')->disabled(fn($record) => !is_null($record))->default(
          function (RelationManager $livewire) {
            return $livewire->ownerRecord->id;
          }
        )->hidden(),
        Forms\Components\TextInput::make('title')->disabled(fn($record) => !is_null($record))->required()->label(
          'כותרת'
        ),
        Forms\Components\TextInput::make('description')->disabled(fn($record) => !is_null($record))->required()->label(
          'תיאור'
        ),
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
          Forms\Components\TextInput::make('name')->disabled(fn($record) => !is_null($record))->required()->label(
            'שם פריט'
          )->required(),
          Forms\Components\TextInput::make('count')->disabled(fn($record) => !is_null($record))->minValue(0)->numeric(
          )->label('כמות')->default(0),
          Forms\Components\TextInput::make('price')->disabled(fn($record) => !is_null($record))->minValue(0)->label(
            'מחיר'
          )->default(0),
        ])->createItemButtonLabel('הוסף פריט'),
        Forms\Components\RichEditor::make('contracts_content')->disabled(fn($record) => !is_null($record))->label(
            'הערות נוספות'
          )->disableAllToolbarButtons()->toolbarButtons([
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
      Tables\Columns\TextColumn::make('type')->label('סוג מסמך')->sortable()->searchable()
        ->enum([
          '1' => 'הצעת מחיר',
          '2' => 'חוזה',
        ])->color(function(Contract $record) {
          return $record->type == 1 ? 'success' : 'primary';
        })->sortable()->searchable(),
      Tables\Columns\IconColumn::make('id')->falseIcon('heroicon-s-document')->trueIcon(
        'heroicon-s-document'
      )->boolean()->label('הצג מסמך')->url(
        fn($record) => '/contract/'.$record->id.'/view',
        true
      )->sortable()->searchable(),
      Tables\Columns\IconColumn::make('signed_url')->falseIcon('heroicon-s-document')->trueIcon(
        'heroicon-s-document'
      )->boolean()->label('הדפסה')->url(
        fn($record) => '/contract/'.$record->id.'/pdf',
        true
      )->sortable()->searchable(),
      Tables\Columns\TextColumn::make('event.customer.full_name')->label('שם לקוח')->sortable()->searchable(),
      Tables\Columns\TextColumn::make('event.title')->label('אירוע')->sortable()->searchable(),
      Tables\Columns\TextColumn::make('title')->label('כותרת')->sortable()->searchable(),
      Tables\Columns\TextColumn::make('description')->label('תיאור')->limit(20)->sortable()->searchable(),
      Tables\Columns\IconColumn::make('sent')->boolean()->label('נשלח')->sortable()->searchable(),
      Tables\Columns\IconColumn::make('opened')->boolean()->label('נצפה')->sortable()->searchable(),
      Tables\Columns\IconColumn::make('signed')->boolean()->label('נחתם')->sortable()->searchable(),

      Tables\Columns\TextColumn::make('created_at')->label('תאריך יצירה')->sortable()->searchable(),
    ])->headerActions([
      Tables\Actions\CreateAction::make(),
    ])->actions([
      Tables\Actions\EditAction::make(),
    ])->bulkActions([
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
