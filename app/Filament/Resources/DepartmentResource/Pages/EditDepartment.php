<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\Research;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action, Department $record) {
                    $id = $record->id;
                    $exists = Research::where('department_id', $id)->exists();

                    if ($exists) {
                        Notification::make()
                            ->title('Deletion not allowed')
                            ->danger()
                            ->send();

                        $action->cancel();
                    }
                }),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
