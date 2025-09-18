<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $university_name = 'Universitas Koding Bersama';
    public ?int $active_academic_year_id = null;
    public ?string $university_address = null;
    public ?string $university_phone = null;
    public ?string $university_email = null;

    public static function group(): string
    {
        return 'general';
    }
}
