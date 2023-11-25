<?php

namespace App\Filament\Resources\NumberResource\Pages;

use App\Filament\Resources\NumberResource;
use App\Models\Number;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewNumber extends ViewRecord
{
    protected static string $resource = NumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action, Number $record) {
                    $userId = $record->user_id;
                    $exists = User::where('id', $userId)->exists();

                    if ($exists) {
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
