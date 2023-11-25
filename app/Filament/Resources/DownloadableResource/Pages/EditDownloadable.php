<?php

namespace App\Filament\Resources\DownloadableResource\Pages;

use App\Filament\Resources\DownloadableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDownloadable extends EditRecord
{
    protected static string $resource = DownloadableResource::class;

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
