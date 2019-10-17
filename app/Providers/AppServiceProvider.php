<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CountryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Interfaces\BookingCardContract::class,
            \App\Repositories\BookingCardRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\BookingCardDetailContract::class,
            \App\Repositories\BookingCardDetailRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\BookingCardStatusContract::class,
            \App\Repositories\BookingCardStatusRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\CityContract::class,
            \App\Repositories\CityRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\CountryContract::class,
            \App\Repositories\CountryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\CurrencyContract::class,
            \App\Repositories\CurrencyRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\HotelContract::class,
            \App\Repositories\HotelRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\NotificationContract::class,
            \App\Repositories\NotificationRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\NotificationTypeContract::class,
            \App\Repositories\NotificationTypeRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\PermissionContract::class,
            \App\Repositories\PermissionRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\PriceContract::class,
            \App\Repositories\PriceRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\RoleContract::class,
            \App\Repositories\RoleRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\RoomQuantityContract::class,
            \App\Repositories\RoomQuantityRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\RoomTypeContract::class,
            \App\Repositories\RoomTypeRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\ServiceContract::class,
            \App\Repositories\ServiceRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\StatusContract::class,
            \App\Repositories\StatusRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\UserContract::class,
            \App\Repositories\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $countryRepository = new CountryRepository();
        $langs = $countryRepository->all();

        view()->share('langs', $langs);
    }
}
