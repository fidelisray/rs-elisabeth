<?php

namespace App\Filament\Resources\BannerPromotions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class BannerPromotionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->afterReordering(function (): void {
                \Illuminate\Support\Facades\Cache::forget('local_cms_banner_promotions_');
            })
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Preview')
                    ->disk('public')
                    ->width(120)
                    ->height(68), // Menjaga aspek rasio 16:9 pada preview tabel

                TextColumn::make('title')
                    ->label('Judul Banner')
                    ->searchable()
                    ->limit(50),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),



                TextColumn::make('created_by')
                    ->label('Dibuat Oleh')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_by')
                    ->label('Diperbarui Oleh')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
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
