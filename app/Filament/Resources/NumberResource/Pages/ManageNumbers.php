<?php

namespace App\Filament\Resources\NumberResource\Pages;

use App\Filament\Resources\NumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ManageNumbers extends ManageRecords
{
    protected static string $resource = NumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->handleBlankRows(true)
                ->uniqueField('id_number')
                ->fields([
                    ImportField::make('id_number')
                        ->label('ID Number')
                        ->required(),
                ]),
        ];
    }
}
