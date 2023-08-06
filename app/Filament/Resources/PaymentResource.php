<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    protected static ?string $navigationLabel = 'תשלומים';

    protected static ?string $label = 'תשלום';

    protected static ?string $pluralModelLabel = 'תשלומים';

    protected static ?string $breadcrumb = 'תשלום';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('package_id'),
                Forms\Components\TextInput::make('action')
                    ->maxLength(255),
                Forms\Components\TextInput::make('info')
                    ->maxLength(255),
                Forms\Components\TextInput::make('heshDesc')
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount'),
                Forms\Components\TextInput::make('payment_status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_method')
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('payment_date'),
                Forms\Components\Textarea::make('request'),
                Forms\Components\Textarea::make('response'),
                Forms\Components\TextInput::make('transaction_code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_status')
                    ->maxLength(255),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('שם משתמש'),
                Tables\Columns\TextColumn::make('package.name')->label('שם חבילה'),
                Tables\Columns\TextColumn::make('action')->label('פעולה'),
                Tables\Columns\TextColumn::make('info')->label('מידע'),
                Tables\Columns\TextColumn::make('heshDesc')->label('תיאור'),
                Tables\Columns\TextColumn::make('amount')->label('סכום'),
                Tables\Columns\TextColumn::make('payment_status')->label('סטטוס תשלום'),
                Tables\Columns\TextColumn::make('payment_method')->label('אמצעי תשלום'),
                Tables\Columns\TextColumn::make('transaction_id')->label('מספר עסקה'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->dateTime()->label('תאריך תשלום'),
                Tables\Columns\TextColumn::make('request')->label('בקשה'),
                Tables\Columns\TextColumn::make('response')->label('תגובה'),
                Tables\Columns\TextColumn::make('transaction_code')->label('קוד עסקה'),
                Tables\Columns\TextColumn::make('transaction_status')->label('סטטוס עסקה'),
                Tables\Columns\TextColumn::make('created_at')->label('נוצר בתאריך')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->label('עודכן בתאריך'),
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
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
            'index' => Pages\ListPayments::route('/'),
           /* 'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),*/
        ];
    }
}
