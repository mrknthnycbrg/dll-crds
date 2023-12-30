<?php

namespace App\Livewire\Ask;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class AskPage extends Component
{
    public $input = '';

    public $output = '';

    public function response()
    {
        if (!empty($this->input)) {
            $prompt = 'Suggest research titles based on this topic: ' . $this->input;

            $response = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbo',
                'prompt' => $prompt,
                'max_tokens' => 100,
            ]);

            $this->output = $response['choices'][0]['text'];
        }
    }

    public function render()
    {
        return view('livewire.ask.ask-page')
            ->layout('layouts.app')
            ->title('Ask AI - DLL-CRDS');
    }
}
