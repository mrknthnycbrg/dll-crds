<?php

namespace App\Livewire\Ask;

use Livewire\Attributes\Layout;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class AskPage extends Component
{
    public $input = '';

    public $output = '';

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ask.ask-page');
    }

    public function response()
    {
        if (! empty($this->input)) {
            $response = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbo',
                'prompt' => $this->input,
                'max_tokens' => 100,
            ]);

            $this->output = $response['choices'][0]['text'];
        }
    }
}
