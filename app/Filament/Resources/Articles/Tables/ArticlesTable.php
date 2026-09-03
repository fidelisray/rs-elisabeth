<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Preview')
                    ->disk('public')
                    ->width(80)
                    ->height(50),
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),
                TextColumn::make('tags')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('views')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
