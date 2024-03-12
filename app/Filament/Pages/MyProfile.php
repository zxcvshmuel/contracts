<?php

namespace App\Filament\Pages;

use App\Helpers;
use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use JeffGreco13\FilamentBreezy\FilamentBreezy;
use JeffGreco13\FilamentBreezy\Traits\HasBreezyTwoFactor;
use Livewire\TemporaryUploadedFile;
use Savannabits\SignaturePad\Forms\Components\Fields\SignaturePad;
use Spatie\Image\Manipulations;

class MyProfile extends Page {
    use HasBreezyTwoFactor;

    protected static string $view = "filament.pages.my-profile";

    public User $user;
    public array $userData;
    // Password
    public $new_password;
    public $new_password_confirmation;
    // Sanctum tokens
    public $token_name;
    public $abilities = [];
    public $plain_text_token;
    protected $loginColumn;

    public function boot()
    {
        // user column
        $this->loginColumn = config('filament-breezy.fallback_login_field');
    }

    public function mount()
    {
        $this->user = Filament::auth()->user();
        $this->updateCompanyProfileForm->fill($this->user->toArray());
    }


    protected function getForms(): array
    {
        return array_merge(parent::getForms(), [
            "updateProfileForm"        => $this->makeForm()->model(User::class)->schema(
                $this->getUpdateProfileFormSchema()
            )->statePath('userData'),

            // Start -- New Section for MyProfile Account Page
            "updateCompanyProfileForm" => $this->makeForm()->model(User::class)->schema(
                $this->getUpdateCompanyProfileFormSchema()
            )->statePath('userData'),
            // End -- New Section for MyProfile Account Page

            "updateProfileCustomTextForm" => $this->makeForm()->model(User::class)->schema(
                $this->getUpdateProfileCustomTextSchema()
            )->statePath('userData'),

            "updatePasswordForm"   => $this->makeForm()->schema(
                $this->getUpdatePasswordFormSchema()
            ),
            "createApiTokenForm"   => $this->makeForm()->schema(
                $this->getCreateApiTokenFormSchema()
            ),
            "confirmTwoFactorForm" => $this->makeForm()->schema(
                $this->getConfirmTwoFactorFormSchema()
            ),
        ]);
    }


    protected function getActions(): array
    {
        return [

            Action::make('logo_url')->icon('heroicon-s-user')->label('להוספת/החלפת לוגו')->mountUsing(
                fn(Forms\ComponentContainer $form) => $form->fill([
                    $this->user->toArray(),
                ])
            )->action(function (Action $action): void {
                $files = $this->mountedActionData['logo_url'];
                foreach ($files as $key => $val)
                {
                    $this->user->update([
                        'logo_url' => $val,
                    ]);
                }
                $this->notify("success", 'הלוגו עודכן בהצלחה', true);
                $this->redirect(url('/admin/my-profile'));
            })->form($this->getUpdateProfileLogoSchema()),
            Action::make('google-auth')->icon('heroicon-s-calendar')
                ->label('חיבור יומן גוגל')
                ->hidden(fn() => $this->user->two_factor_secret !== null && $this->user->two_factor_secret !== '')
                ->action(
                    function (Action $action): void {
                        $this->redirect(Helpers::createUrlForGoogleToken());
                    }
                )
            ->requiresConfirmation()->modalSubheading('האירועים שלך יסונכרנו בין כתובת המייל לאירועים שנקבעו')
            ->modalButton('המשך לחיבור יומן גוגל')
        ];
    }

    protected function getUpdateProfileLogoSchema(): array
    {
        return [
            Forms\Components\FileUpload::make('logo_url')->directory('logos')->required(),
            //                ->default(\Illuminate\Support\Facades\Storage::url('/') . $this->user->logo_url)

        ];
    }

    protected function getUpdateProfileFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required()->label('שם'),
            Forms\Components\TextInput::make($this->loginColumn)->required()->email(
                fn() => $this->loginColumn === 'email'
            )->unique(config('filament-breezy.user_model'), ignorable: $this->user)->label(
                'מייל'
            ),
            Forms\Components\TextInput::make('uid')->maxLength(10)->required()->label('תעודת זהות'),
            Forms\Components\TextInput::make('phone')->tel()->maxLength(255)->label('טלפון'),
            Forms\Components\DateTimePicker::make('active_until')->displayFormat('d/m/Y')->label('פעיל עד')->disabled(),
            Select::make('contract_color')->label('צבע רקע לחוזה')
            ->options([
                '#2cb4f34d' => 'כחול ברירת מחדל',
                '#ffffff' => 'לבן',
                '#00ff4161' => 'ירוק',
                '#ffeb3b63' => 'צהוב',
                '#ff3b8930' => 'ורוד',

            ]),
        ];
    }

    protected function getUpdateProfileCustomTextSchema(): array
    {
        return [
            Forms\Components\RichEditor::make('custom_text')->label('טקסט קבוע בחוזה (מופיע תחת תנאים והגבלות)'),
        ];
    }

    public function updateProfile()
    {
        $this->user->update($this->updateProfileForm->getState());
        $data = $this->updateProfileForm->getState();
        if (empty($this->user->comp_id)) {
            $this->user->comp_id = $data['uid'];
        }

        if (empty($this->user->comp_name)) {
            $this->user->comp_name = $data['name'];
        }

        if (empty($this->user->comp_email)) {
            $this->user->comp_email = $data['email'];
        }

        if (empty($this->user->comp_phone)) {
            $this->user->comp_phone = $data['phone'];
        }

        if (empty($this->user->comp_address)) {
            $this->user->comp_address = $data['address'];
        }

        $this->user->save();

        $this->notify("success", 'עודכן בהצלחה');
    }


    public function updateCustomTextProfile()
    {
        $data = $this->updateProfileCustomTextForm->getState();
        $this->user->custom_text = $data['custom_text'];
        $this->user->save();
        $this->notify("success", 'עודכן בהצלחה');

        $this->notify("success", 'עודכן בהצלחה');
    }


    // Start -- New Section for "Updating" MyProfile Account Page
    protected function getUpdateCompanyProfileFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('comp_id')->maxLength(255)->label('מספר חברה ח.פ'),
            Forms\Components\TextInput::make('comp_name')->maxLength(255)->label('שם חברה'),
            Forms\Components\TextInput::make('comp_email')->email()->maxLength(255)->label('מייל חברה'),
            Forms\Components\TextInput::make('comp_phone')->tel()->maxLength(255)->label('טלפון חברה'),
            Forms\Components\TextInput::make('comp_address')->maxLength(255)->label('כתובת חברה'),
            Select::make('licensed_dealer')->options([
                '1' => 'כן',
                '0' => 'לא',
            ])->label('עוסק מורשה'),
            //            Forms\Components\SpatieMediaLibraryFileUpload::make($this->user->getFirstMedia()?? 'logo_url')->responsiveImages()->label($this->user->getFirstMedia()),
            SignaturePad::make('signature')->disabled(false)->strokeMinWidth(1.0)->strokeMaxWidth(2.5)->strokeDotSize(
                2.0
            )->penColor('rgb(0,0,255)') // Blue
            ->backgroundColor('rgba(0,0,0,0)'),
        ];
    }


    public function updateCompanyProfile()
    {
        $this->user->update($this->updateCompanyProfileForm->getState());
        $this->notify("success", 'עודכן בהצלחה');
    }

    // End -- New Section for "Updating" MyProfile Account Page

    protected function getUpdatePasswordFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make("new_password")->label(
                'סיסמא חדשה'
            )->password()->rules(app(FilamentBreezy::class)->getPasswordRules())->required(),
            Forms\Components\TextInput::make("new_password_confirmation")->label(
                'אישור סיסמא'
            )->password()->same("new_password")->required(),
        ];
    }

    public function updatePassword()
    {
        $state = $this->updatePasswordForm->getState();
        $this->user->update([
            "password" => Hash::make($state["new_password"]),
        ]);
        session()->forget("password_hash_web");
        Filament::auth()->login($this->user);
        $this->notify("success", __('filament-breezy::default.profile.password.notify'));
        $this->reset(["new_password", "new_password_confirmation"]);
    }

    protected function getCreateApiTokenFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('token_name')->label(
                __('filament-breezy::default.fields.token_name')
            )->required(),
            Forms\Components\CheckboxList::make('abilities')->label(
                __('filament-breezy::default.fields.abilities')
            )->options(config('filament-breezy.sanctum_permissions'))->columns(2)->required(),
        ];
    }

    public function createApiToken()
    {
        $state = $this->createApiTokenForm->getState();
        $indexes = $state['abilities'];
        $abilities = config("filament-breezy.sanctum_permissions");
        $selected = collect($abilities)->filter(function ($item, $key) use (
            $indexes
        ) {
            return in_array($key, $indexes);
        })->toArray();
        $this->plain_text_token = Filament::auth()->user()->createToken(
            $state['token_name'],
            array_values($selected)
        )->plainTextToken;
        $this->notify("success", __('filament-breezy::default.profile.sanctum.create.notify'));
        $this->emit('tokenCreated');
        $this->reset(['token_name']);
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => __('filament-breezy::default.profile.profile'),
        ];
    }

    protected static function getNavigationIcon(): string
    {
        return config('filament-breezy.profile_page_icon', 'heroicon-o-document-text');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-breezy::default.profile.account');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-breezy::default.profile.profile');
    }

    protected function getTitle(): string
    {
        return __('filament-breezy::default.profile.my_profile');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return config('filament-breezy.show_profile_page_in_navbar');
    }


}
