<?php

namespace App\Providers;

use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
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

        // \URL::forceScheme('https');

        // TODO:
        $this->app->bind(Llm::class, fn () => new OpenAI());
    }
}
