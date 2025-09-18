<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class WelcomeWidget extends Widget
{
    protected static string $view = 'filament.widgets.welcome-widget';

    protected static ?int $sort = -3; // Angka minus biar posisinya paling atas

    //protected static bool $isDiscovered = false;

    // Ambil nama user yang sedang login
    public function getAuthenticatedUserName(): string
    {
        return Auth::user()->name;
    }
}
