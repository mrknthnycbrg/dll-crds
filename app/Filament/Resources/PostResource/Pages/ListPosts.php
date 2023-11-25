<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->handleBlankRows(true)
                ->uniqueField('title')
                ->fields([
                    ImportField::make('title')
                        ->label('Title')
                        ->rules('required')
                        ->mutateBeforeCreate(fn ($value) => Str::title($value)),
                    ImportField::make('topic')
                        ->label('Topics'),
                    ImportField::make('content')
                        ->label('Content'),
                    ImportField::make('date_published')
                        ->label('Date Published')
                        ->mutateBeforeCreate(fn ($value) => Date::excelToDateTimeObject($value)
                            ->format('Y-m-d')),
                ]),
        ];
    }
}
