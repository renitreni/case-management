<?php

namespace App\Filament\Resources\CaseTypeResource\Pages;

use App\Filament\Resources\CaseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCaseTypes extends ManageRecords
{
    protected static string $resource = CaseTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
