<?php

namespace App\Livewire\Welcome;

use Livewire\Component;

class WelcomePage extends Component
{
    public function render()
    {
        return view('livewire.welcome.welcome-page')
            ->layout('layouts.guest');
    }
}
