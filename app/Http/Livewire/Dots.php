<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dots extends Component
{
    public int $amountOfDots;
    public int $selectedDot;

    public function render()
    {
        return view('livewire.dots', [
            'amountOfDot' => $this->amountOfDots,
            'selectedDot' => $this->selectedDot
        ]);
    }
}
