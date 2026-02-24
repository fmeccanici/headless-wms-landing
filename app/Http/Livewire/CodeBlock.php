<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CodeBlock extends Component
{
    public string $lines;

    public function render()
    {
        return view('livewire.code-block', [
            'lines' => $this->lines
        ]);
    }
}
