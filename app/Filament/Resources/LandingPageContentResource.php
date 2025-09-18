<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageContentResource\Pages;
use App\Filament\Resources\LandingPageContentResource\RelationManagers;
use App\Models\LandingPageContent;
use Filament\Forms\Components\{TextInput, Textarea};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\{EditAction, DeleteAction};
use Filament\Tables\Columns\{TextColumn};
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandingPageContentResource extends Resource
{
    protected static ?string $model = LandingPageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $modelLabel = 'Konten Landing Page';

    public static function canViewAny(): bool
    {
        // Kita ambil user yang sedang login menggunakan helper auth()
        // lalu cek rolenya.
        return Auth::user()->hasRole('Super Admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('section')
                    ->required()
                    ->disabled(fn(string $operation): bool => $operation === 'edit')
                    ->maxLength(255),
                Textarea::make('content')
                    ->label('Isi Konten')
                    ->required()
                    ->rows(5),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section')
                    ->label('Bagian Halaman'),
                TextColumn::make('content')
                    ->label('Isi Konten')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label('Ubah Data'),
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
            'index' => Pages\ListLandingPageContents::route('/'),
            'create' => Pages\CreateLandingPageContent::route('/create'),
            'edit' => Pages\EditLandingPageContent::route('/{record}/edit'),
        ];
    }
}
