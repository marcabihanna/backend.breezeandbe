<?php

namespace App\Filament\Resources\HowToUseResource\Pages;

use App\Filament\Resources\HowToUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHowToUse extends ViewRecord
{
    protected static string $resource = HowToUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
