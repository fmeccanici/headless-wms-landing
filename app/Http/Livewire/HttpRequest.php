<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HttpRequest extends Component
{
    public string $request;
    public string $content;

    public function render()
    {
        return view('livewire.http-request');
    }
}
