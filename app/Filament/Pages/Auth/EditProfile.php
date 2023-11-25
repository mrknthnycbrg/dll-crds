<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('middle_name')
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
