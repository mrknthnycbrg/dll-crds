<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ListResearch extends ListRecords
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('title')
                ->fields([
                    ImportField::make('title')
                        ->label('Title')
                        ->required()
                        ->mutateBeforeCreate(fn ($value) => Str::title($value)),
                    ImportField::make('author')
                        ->label('Authors')
                        ->mutateBeforeCreate(fn ($value) => Str::title($value)),
                    ImportField::make('date_submitted')
                        ->label('Date Submitted')
                        ->mutateBeforeCreate(fn ($value) => Date::excelToDateTimeObject($value)
                            ->format('Y-m-d')),
                    ImportField::make('department_id')
                        ->label('Department'),
                    ImportField::make('adviser')
                        ->label('Adviser')
                        ->mutateBeforeCreate(fn ($value) => Str::title($value)),
                    ImportField::make('keyword')
                        ->label('Keywords'),
                    ImportField::make('abstract')
                        ->label('Abstract'),
                ]),
        ];
    }
}
