<?php

namespace App\Filament\Onboarding\Resources\SourceCodeAccountResource\Pages;

use App\Filament\Onboarding\Resources\SourceCodeAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSourceCodeAccount extends EditRecord
{
    protected static string $resource = SourceCodeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
