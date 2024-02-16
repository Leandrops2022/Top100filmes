<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ResetDeSenha extends Component
{
    public $textoBotao = 'Redefinir Senha';

    public function render()
    {
        return view('livewire.reset-de-senha');
    }

    public function mudarTextoBotao()
    {
        $this->textoBotao = "Aguarde...";
    }
}
