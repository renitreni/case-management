<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseSubTypeResource\RelationManagers\CaseSubTypeRelationManager;
use App\Filament\Resources\CaseTypeResource\Pages;
use App\Models\CaseType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CaseTypeResource extends Resource
{
    protected static ?string $model = CaseType::class;

    protected static ?string $navigationGroup = 'Variables';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
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
            CaseSubTypeRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaseTypes::route('/'),
            'create' => Pages\CreateCaseType::route('/create'),
            'edit' => Pages\EditCaseType::route('/{record}/edit'),
        ];
    }
}
