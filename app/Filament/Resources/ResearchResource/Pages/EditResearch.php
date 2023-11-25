<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearch extends EditRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
