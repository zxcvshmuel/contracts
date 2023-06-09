<?php

namespace App\Providers;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\EventsResource;
use App\Filament\Resources\ExpenseResource;
use App\Filament\Resources\IncomeResource;
use App\Filament\Resources\PackageResource;
use App\Filament\Resources\PriceOffersResource;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use JeffGreco13\FilamentBreezy\Pages\MyProfile;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource;
use Sgcomptech\FilamentTicketing\Filament\Resources\TicketResource;

class FilamentServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {

            Filament::registerViteTheme('resources/css/filament.css');

            $color = auth()->user()->color ?? 'blue';

            switch ($color)
            {
                case 'red':
                    $primaryColor = '#FF0000';
                    $secondaryColor = '#3788d8';
                    break;
                case 'green':
                    $primaryColor = '#23bf45';
                    $secondaryColor = '#3788d8';
                    break;
                case 'orange':
                    $primaryColor = '#FF8834';
                    $secondaryColor = '#BBAA87';
                    break;
                case 'blue':
                    $primaryColor = '#3788d8';
                    $secondaryColor = '#FF8834';
                    break;
                default:
                    $primaryColor = '#3788d8';
                    $secondaryColor = '23bf45';
                    break;
            }


            Filament::pushMeta([
                new HtmlString(
                    '<meta name="theme-primary-color" id="theme-primary-color" content="'.$primaryColor.'">'.'<meta name="theme-secondary-color" id="theme-secondary-color" content="'.$secondaryColor.'">'
                ),
            ]);

            Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
        if (auth()->user()->user_type == 0)
                {
                    return $builder->items([
                        NavigationItem::make('howTo')->label('מתחילים (הסבר המערכת)')->icon(
                            'heroicon-o-beaker'
                        )->activeIcon(
                            'heroicon-s-beaker'
                        )->url(route('filament.pages.how-to')),
                        NavigationItem::make('Dashboard')->label('בית')->icon('heroicon-o-home')->activeIcon(
                            'heroicon-s-home'
                        )->isActiveWhen(fn(): bool => request()->routeIs('filament.pages.dashboard'))->url(
                            route('filament.pages.dashboard')
                        ),
                        NavigationItem::make('account')->label('הפרופיל שלי')->icon('heroicon-o-user')->activeIcon(
                            'heroicon-s-user'
                        )->url(route('filament.pages.my-profile')),
                        NavigationItem::make('account')->label('telescope')->icon('heroicon-o-user')->activeIcon(
                            'heroicon-s-user'
                        )->url(route('telescope')),
                        NavigationItem::make('account')->label('horizon')->icon('heroicon-o-user')->activeIcon(
                            'heroicon-s-user'
                        )->url(route('horizon.index')),
                        ...UserResource::getNavigationItems(),
                        ...PackageResource::getNavigationItems(),
                        ...CustomerResource::getNavigationItems(),
                        ...EventsResource::getNavigationItems(),
                        ...ContractsResource::getNavigationItems(),
                        ...PriceOffersResource::getNavigationItems(),
                        ...EmailResource::getNavigationItems(),
                        ...TicketResource::getNavigationItems(),
                    ])->groups([
                            NavigationGroup::make('הכנסות והוצאות')->icon('heroicon-o-cash')->items([
                                    ...ExpenseResource::getNavigationItems(),
                                    ...IncomeResource::getNavigationItems(),
                                    ...CategoryResource::getNavigationItems(),
                                ]),
                        ])
                        ->items([
                            NavigationItem::make('packages')->label('החבילות שלנו')->icon('heroicon-o-home')->activeIcon(
                                'heroicon-s-home'
                            )->isActiveWhen(fn(): bool => request()->routeIs('filament.pages.packages-page'))->url(
                                route('filament.pages.packages-page'))
                        ]);
                } else
                {
                    return $builder->items([
                        NavigationItem::make('howTo')->label('מתחילים (הסבר המערכת)')->icon('heroicon-o-beaker')->activeIcon(
                            'heroicon-s-beaker'
                        )->url(route('filament.pages.how-to')),
                        NavigationItem::make('Dashboard')->label('בית')->icon('heroicon-o-home')->activeIcon(
                            'heroicon-s-home'
                        )->isActiveWhen(fn(): bool => request()->routeIs('filament.pages.dashboard'))->url(
                            route('filament.pages.dashboard')
                        ),
                        NavigationItem::make('account')->label('הפרופיל שלי')->icon('heroicon-o-user')->activeIcon(
                            'heroicon-s-user'
                        )->url(route('filament.pages.my-profile')),
                        ...CustomerResource::getNavigationItems(),
                        ...EventsResource::getNavigationItems(),
                        ...ContractsResource::getNavigationItems(),
                        ...PriceOffersResource::getNavigationItems(),
                        ...TicketResource::getNavigationItems(),
                    ])->groups([
                        NavigationGroup::make('הכנסות והוצאות')->icon('heroicon-o-cash')->items([
                            ...ExpenseResource::getNavigationItems(),
                            ...IncomeResource::getNavigationItems(),
                            ...CategoryResource::getNavigationItems(),
                        ]),
                    ]);
                }
            });

            Filament::registerUserMenuItems([
                UserMenuItem::make()->label('בית')->url(route('filament.pages.dashboard'))->icon('heroicon-o-home'),
                userMenuItem::make()->label('הפרופיל שלי')->url(MyProfile::getUrl())->icon('heroicon-o-user'),
                userMenuItem::make()->label('הצעת מחיר מהירה')->url(PriceOffersResource::getUrl())->icon('heroicon-o-calendar'),
                userMenuItem::make()->label('לקוחות')->url(CustomerResource::getUrl())->icon('heroicon-o-collection'),
                userMenuItem::make()->label('חוזים')->url(ContractsResource::getUrl())->icon('heroicon-o-calendar'),
                userMenuItem::make()->label('אירועים')->url(EventsResource::getUrl())->icon('heroicon-o-calendar'),
                userMenuItem::make()->label('הוצאות')->url(ExpenseResource::getUrl())->icon('heroicon-o-calendar'),
                userMenuItem::make()->label('הכנסות')->url(IncomeResource::getUrl())->icon('heroicon-o-calendar'),
                userMenuItem::make()->label('קטגוריות')->url(CategoryResource::getUrl())->icon('heroicon-o-calendar'),
            ]);

        });
    }
}
