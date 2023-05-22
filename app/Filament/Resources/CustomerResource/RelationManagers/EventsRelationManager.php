<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Helpers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventsRelationManager extends RelationManager {
    protected static string $relationship = 'Events';

    protected static ?string $recordTitleAttribute = 'אירועים';

    protected static ?string $label = 'אירוע';

    protected static ?string $pluralModelLabel = 'אירועים';

    protected static ?string $breadcrumb = 'אירועים';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\TextInput::make('customer_id')->default(function (RelationManager $livewire){
                    return $livewire->ownerRecord->id;
                })->required()->hidden(),
                Forms\Components\TextInput::make('city')->label('עיר')->maxLength(255),
                Forms\Components\TextInput::make('address')->label('רחוב ומספר בית')->maxLength(255),
                Forms\Components\TextInput::make('title')->label('כותרת')->required()->maxLength(255),
                Forms\Components\TextInput::make('content')->label('תוכן')->maxLength(255),
                Forms\Components\TextInput::make('type')->label('סוג')->maxLength(255),
                Forms\Components\DateTimePicker::make('date')->label('התחלה')->closeOnDateSelection()->required(),
                Forms\Components\DateTimePicker::make('end_at')->label('סיום')->closeOnDateSelection()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('customer.full_name')->label('שם לקוח')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('city')->label('עיר')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('address')->label('רחוב ומספר בית')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('כותרת')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('content')->label('תוכן')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->label('סוג')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date')->label('תאריך')->sortable()->searchable()->dateTime(),
            ])->filters([
                Tables\Filters\TrashedFilter::make(),
            ])->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                  $user = auth()->user();
                  if ($user->two_factor_secret !== null)
                  {
                    $event = [
                      'title' => $data['title'],
                      'start' => $data['date'],
                      'end'   => $data['end_at'],
                    ];

                    Helpers::createEvent(auth()->user(), $event);
                  }

                  return $data;
                }),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
