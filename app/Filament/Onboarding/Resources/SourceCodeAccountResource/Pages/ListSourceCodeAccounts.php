<?php

namespace App\Filament\Onboarding\Resources\SourceCodeAccountResource\Pages;

use App\Filament\Onboarding\Resources\SourceCodeAccountResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;

class ListSourceCodeAccounts extends ListRecords
{
    protected static string $resource = SourceCodeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('github')
                    ->label('Github')
                    ->icon('icon-github1')
                    ->url(route('github.redirect')),
                Action::make('gitlab')
                    ->label('Gitlab')
                    ->icon('icon-gitlab1')
                    ->form(function () {
                        return [
                            TextInput::make('name'),
                            TextInput::make('app_token')
                                ->helperText(new HtmlString('You can generate a Personal Access Token for Gitlab <a
                                href="https://gitlab.com/-/user_settings/personal_access_tokens" target="_blank"
                                class="underline">here</a>. Make sure to select the <strong>api</strong> scope.')),
                        ];
                    })
                    ->action(function(array $data){
                        dd($data);
                        //TODO: after multi-tenancy implemented call StoreAccountPersonalAccessToken with the required parameters
                    }),
                Action::make('bitbucket')
                    ->label('Bitbucket')
                    ->icon('icon-bitbucket1')
                    ->form(function () {
                        return [
                            TextInput::make('name'),
                            TextInput::make('app_token')
                                ->helperText(new HtmlString('You can generate an App Password for Bitbucket <a
                                href="https://bitbucket.org/account/settings/app-passwords/" target="_blank"
                                class="underline">here</a>. Make sure to select the <strong>Read</strong> permissions in
                            <strong>Account and Repositories</strong>, and <strong>Read and write</strong> in
                            <strong>Webhooks</strong>.')),
                        ];
                    })
                    ->action(function(array $data){
                        dd($data);
                        //TODO: after multi-tenancy implemented call StoreAccountPersonalAccessToken with the required parameters
                    }),
            ])
                ->label('Add new source code account')
                ->icon('')
                ->size(ActionSize::Small)
                ->color(Color::Violet)
                ->button(),
        ];
    }
}
