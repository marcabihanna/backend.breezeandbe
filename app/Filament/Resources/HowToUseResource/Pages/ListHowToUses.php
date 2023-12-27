<?php

namespace App\Filament\Resources\HowToUseResource\Pages;

use App\Filament\Resources\HowToUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHowToUses extends ListRecords
{
    protected static string $resource = HowToUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
