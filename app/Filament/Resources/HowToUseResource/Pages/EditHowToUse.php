<?php

namespace App\Filament\Resources\HowToUseResource\Pages;

use App\Filament\Resources\HowToUseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHowToUse extends EditRecord
{
    protected static string $resource = HowToUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
