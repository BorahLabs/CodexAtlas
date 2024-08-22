<?php

namespace App\Filament\Onboarding\Resources\RepositoryResource\Pages;

use App\Filament\Onboarding\Resources\RepositoryResource;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepository extends EditRecord
{
    protected static string $resource = RepositoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $data['username'] . '/' . $data['name'];
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $account = SourceCodeAccount::query()->find($data['source_code_account_id']);

        if ($account->provider->isBitbucket()) {
            $repo = collect($account->getProvider()->repositories())->where('fullName', $data['name'])->first();

            $data['username'] = $repo->owner;
            $data['name'] = $repo->name;
            $data['workspace'] = $repo->workspace;
        } else {
            $parts = explode('/', $data['name']);

            $data['username'] = $parts[0];
            $data['name'] = $parts[1];
        }

        return $data;
    }
}
