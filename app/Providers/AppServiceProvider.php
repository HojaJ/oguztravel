<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Service;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $services = [];
        $copyright = null;
        $socials = [];
        $contacts = [];

        try {
            $services = Service::whereIsActive(true)->orderByRaw("FIELD(slug, \"visa\", \"ticket\", \"hotel\", \"translation\")")->get();
            $copyright = Contact::whereSlug('copyright')->whereIsActive(true)->first();
            $socials = Contact::whereType('social')->whereIsActive(true)->get();
            $contacts = Contact::where('type', 'contact')->orWhere('type', 'email')->whereIsActive(true)->get();
        } catch (\Exception $e) {
            Log::info($e);
        }

        $share = [
            'services' => $services,
            'copyright' => $copyright,
            'socials' => $socials,
            'contacts' => $contacts,
        ];

        View::share('share', $share);

        Paginator::useBootstrapFive();
    }
}
