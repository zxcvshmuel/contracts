<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Package;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\TemporaryUploadedFile;
use Savannabits\SignaturePad\Forms\Components\Fields\SignaturePad;

class UserResource extends Resource {
    protected static ?string $model = User::class;

    //protected static bool $shouldRegisterNavigation =  false;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'משתמשים';

    protected static ?string $label = 'משתמש';

    protected static ?string $pluralModelLabel = 'משתמשים';

    protected static ?string $breadcrumb = 'משתמשים';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->user_type === 0)
        {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->where('id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        static::getNavigationLabel();

        return $form->schema([
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255)->label('שם'),
                Forms\Components\TextInput::make('uid')->maxLength(10)->label('ת.ז.'),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255)->label('מייל'),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(255)->label('טלפון')->minLength(
                    10
                )->maxLength(10),
                Forms\Components\TextInput::make('password')->password()->maxLength(255)->dehydrateStateUsing(
                    static fn(null|string $state): null|string => filled($state) ? Hash::make($state) : null,
                )->required(static fn(Page $livewire): bool => $livewire instanceof CreateUser,)->dehydrated(
                    static fn(null|string $state): bool => filled($state),
                )->label(
                    static fn(Page $livewire): string => ($livewire instanceof EditUser) ? 'החלפת סיסמה' : 'סיסמה'
                ),
                Forms\Components\DateTimePicker::make('active_until')->displayFormat('d/m/Y')->closeOnDateSelection()->label('פעיל עד'),
                ])
                ->columns([
                    'sm' => 1,
                ])->columnSpan(1),
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('comp_id')->maxLength(255)->label('מספר חברה ח.פ'),
                Forms\Components\TextInput::make('comp_name')->maxLength(255)->label('שם חברה'),
                Forms\Components\TextInput::make('comp_email')->email()->maxLength(255)->label('מייל חברה'),
                Forms\Components\TextInput::make('comp_phone')->tel()->maxLength(255)->label('טלפון חברה'),
                Forms\Components\TextInput::make('comp_address')->maxLength(255)->label('כתובת חברה'),
//                SignaturePad::make('signature')->label('חתימה'),
            ])
                ->columns([
                    'sm' => 1,
                ])->columnSpan(1),
            Forms\Components\Card::make()->schema([
                Forms\Components\Toggle::make('change_package')->label('שינוי או חידוש חבילה')
                    ->offColor('danger')->onColor('success')
                    ->default(fn (string $context) => $context === 'create' ? 'true' : false)->reactive()
                    ->hiddenOn('create'),
                Forms\Components\Select::make('package_id')
                    ->label('חבילות')->required()
                    ->options(Package::all()->where('status', true)->pluck( 'name', 'id'))
                    ->hidden(fn (Closure $get) => $get('change_package') != true),
            ])->columns([
                'sm' => 1,
            ])->columnSpan(1),

        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->headerActions([
            FilamentExportHeaderAction::make('export')->label('יצוא'),
        ])->columns([
            Tables\Columns\ImageColumn::make('logo_url')->label('לוגו'),
            Tables\Columns\TextColumn::make('name')->label('שם')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email')->label('מייל')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('טלפון')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('תאריך הקמה')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('active_until')->dateTime()->label('תוקף מנוי')->sortable()->searchable(
            )->color(static fn(User $user): string => $user->active() ? 'success' : 'danger'),
        ])->filters([
            Tables\Filters\TrashedFilter::make(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\ForceDeleteBulkAction::make(),
            Tables\Actions\RestoreBulkAction::make(),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
