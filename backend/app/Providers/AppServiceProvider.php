<?php

namespace App\Providers;

use App\LLM\Contracts\Llm;
use App\LLM\DumbLocalLlm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Model::unguard();

        // TODO:
        $this->app->bind(Llm::class, fn () => new DumbLocalLlm());
    }
}
