<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'חבילות';

    protected static ?string $label = 'חבילה';

    protected static ?string $pluralModelLabel = 'חבילות';

    protected static ?string $breadcrumb = 'חבילות';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('שם')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')->label('תיאור')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')->label('מחיר')
                    ->required(),
                Forms\Components\TextInput::make('duration')->label('משך')
                    ->required(),
                Forms\Components\Toggle::make('status')->label('סטטוס')->default(true)
                    ->onColor('success')->offColor('danger')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('שם'),
                Tables\Columns\TextColumn::make('description')->label('תיאור'),
                Tables\Columns\TextColumn::make('price')->label('מחיר'),
                Tables\Columns\TextColumn::make('duration')->label('משך'),
                Tables\Columns\IconColumn::make('status')->label('סטטוס')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('נוצר בתאריך')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('עודכן בתאריך')
                    ->dateTime(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
