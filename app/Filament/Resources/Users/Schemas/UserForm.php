<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                Select::make('role')
                    ->label('Role / Jabatan')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'staff'       => 'Staf',
                    ])
                    ->default('staff')
                    ->required(),

                // Password hanya muncul saat Create, bukan Edit
                // Saat Edit, reset password dilakukan via aksi tabel
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->helperText('Kosongkan jika tidak ingin mengubah password. Untuk user baru, password default adalah "123456".')
                    ->columnSpanFull(),
            ]);
    }
}

