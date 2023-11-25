<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Number;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use STS\FilamentImpersonate\Pages\Actions\Impersonate;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Impersonate::make()->record($this->getRecord()),
            Actions\EditAction::make(),
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action, User $record) {
                    $id = $record->id;
                    $superAdmin = $record->hasRole('Super Admin');
                    $exists = Number::where('user_id', $id)->exists();

                    if ($superAdmin || $exists) {
                        Notification::make()
                            ->title('Deletion not allowed')
                            ->danger()
                            ->send();

                        $action->cancel();
                    }
                }),
        ];
    }
}
