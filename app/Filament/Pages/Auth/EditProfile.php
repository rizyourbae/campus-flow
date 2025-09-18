<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Storage;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Akun')->schema([
                    FileUpload::make('profile_photo_path')
                        ->label('Foto Profil')
                        ->image()
                        ->imageEditor()
                        ->avatar()
                        ->circleCropper()
                        ->directory('avatars')
                        ->disk('public'),
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true),
                ])->columns(2),

                Section::make('Ubah Password')
                    ->description('Kosongkan bagian ini jika Anda tidak ingin mengubah password.')
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->dehydrated(fn($state) => filled($state))
                            ->label('Password Baru'),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->dehydrated(false)
                            ->requiredWith('password') // <-- Kunci utamanya di sini
                            ->label('Konfirmasi Password Baru'),
                    ])->columns(2),
            ]);
    }
}
