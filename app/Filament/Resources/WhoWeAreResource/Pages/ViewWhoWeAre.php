<?php

namespace App\Filament\Resources\WhoWeAreResource\Pages;

use App\Filament\Resources\WhoWeAreResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWhoWeAre extends ViewRecord
{
    protected static string $resource = WhoWeAreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
