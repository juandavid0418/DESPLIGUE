<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Validator::extend('digitos_minimos', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/\d{' . $parameters[0] . ',}/', $value);
        });

        Validator::extend('diferencia_minima_dias', function ($attribute, $value, $parameters, $validator) {
            $fechaInicio = Carbon::parse($validator->getData()[$parameters[1]]);
            $fechaFinal = Carbon::parse($value);
            
            return $fechaInicio->diffInDays($fechaFinal) >= $parameters[0];
        });
    }
}
