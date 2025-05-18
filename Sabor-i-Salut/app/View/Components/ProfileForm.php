<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileForm extends Component
{
    public $user;

    // Constructor per passar la variable user al component
    public function __construct($user)
    {
        $this->user = $user;
    }

    // Renderitza el component
    public function render()
    {
        return view('components.profile-form');
    }
}

