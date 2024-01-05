<?php

namespace App\Filament\Resources\PageComponentResource\Pages;

use App\Filament\Resources\PageComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPageComponent extends ViewRecord
{
    protected static string $resource = PageComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
