<?php

namespace App\Filament\Resources\ContactDetailResource\Pages;

use App\Filament\Resources\ContactDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactDetail extends ViewRecord
{
    protected static string $resource = ContactDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
