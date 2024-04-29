<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseResource\Pages;
use App\Filament\Resources\ClientReourceResource\RelationManagers\ClientsRelationManager;
use App\Models\CaseItem;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CaseResource extends Resource
{
    protected static ?string $model = CaseItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('case_no')->label('Case No.'),
                TextColumn::make('caseType.name')->label('Case Type'),
                TextColumn::make('court.name')->label('Court'),
                TextColumn::make('priority')->label('Priority'),
                TextColumn::make('caseStatus.name')->label('Case Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            ClientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCases::route('/'),
            'create' => Pages\CreateCase::route('/create'),
            'edit' => Pages\EditCase::route('/{record}/edit'),
        ];
    }
}
