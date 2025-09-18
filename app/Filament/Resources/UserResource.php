<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\{Section, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn};
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Table;

use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Akses'; // Grupkan dengan Roles
    public static function getPluralModelLabel(): string
    {
        return ('Manajemen Akun');
    }
    protected static ?string $modelLabel = 'Manajemen Akun';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state)) // Enkripsi password otomatis
                        ->dehydrated(fn($state) => filled($state)) // Hanya proses jika diisi
                        ->required(fn(string $context): bool => $context === 'create'), // Wajib diisi hanya saat buat user baru
                    Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->searchable()
                        ->preload(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                // Tampilkan roles sebagai badge, keren!
                TextColumn::make('roles.name')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
