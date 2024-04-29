<?php

namespace App\Filament\Resources\JudgeTypeResource\Pages;

use App\Filament\Resources\JudgeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJudgeTypes extends ManageRecords
{
    protected static string $resource = JudgeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
