<?php

namespace App\Filament\Resources\CourtTypeResource\Pages;

use App\Filament\Resources\CourtTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCourtTypes extends ManageRecords
{
    protected static string $resource = CourtTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
