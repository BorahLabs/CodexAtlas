<?php

namespace App\Providers;

use App\LLM\Claude;
use App\LLM\Contracts\Llm;
use App\LLM\DumbLocalLlm;
use App\LLM\LMStudio;
use App\LLM\OpenAI;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
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

        if (app()->environment('testing')) {
            $this->app->bind(Llm::class, fn () => new DumbLocalLlm());
        } else {
            $this->app->bind(Llm::class, fn () => match (config('codex.llm')) {
                'lmstudio' => new LMStudio(),
                'claude' => new Claude(),
                default => new OpenAI()
            });
        }

        Livewire::setUpdateRoute(function (mixed $handle) {
            return Route::post('/livewire/update', $handle)
                ->middleware('web', \App\Http\Middleware\ConfigureRequestsFromAutodoc::class);
        });

        FilamentColor::register([
            'primary' => '#5E5299',
            'success' => '#AFC742',
        ]);
    }
}
