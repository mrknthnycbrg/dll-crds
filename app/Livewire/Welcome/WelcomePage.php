<?php

namespace App\Livewire\Welcome;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WelcomePage extends Component
{
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.welcome.welcome-page');
    }
}
