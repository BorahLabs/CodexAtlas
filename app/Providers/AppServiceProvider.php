<?php

namespace App\Providers;

use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Lorisleiva\Actions\Facades\Actions;

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

        Actions::registerCommands();

        $this->app->bind(Llm::class, fn () => new OpenAI());
    }
}
