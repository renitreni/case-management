<?php

namespace App\Filament\Resources\CaseStatusResource\Pages;

use App\Filament\Resources\CaseStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCaseStatuses extends ManageRecords
{
    protected static string $resource = CaseStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
