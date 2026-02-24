<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HttpHeader extends Component
{
    public string $content;

    public function render()
    {
         return view('livewire.http-header', [
             'content' => $this->content
         ]);
    }
}
