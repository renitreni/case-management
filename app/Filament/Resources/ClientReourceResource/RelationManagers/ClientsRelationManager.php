<?php

namespace App\Filament\Resources\ClientReourceResource\RelationManagers;

use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ClientsRelationManager extends RelationManager
{
    protected static string $relationship = 'caseClients';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->searchable()
                    ->getSearchResultsUsing(
                        function (string $search) {
                            return Client::where(
                                DB::raw('CONCAT(first_name, \' \', last_name)'),
                                'like',
                                "{$search}%"
                            )
                                ->limit(50)
                                ->pluck(DB::raw('CONCAT(first_name, \' \', last_name)'), 'id')
                                ->toArray();
                        }
                    )
                    ->getOptionLabelUsing(fn ($value): ?string => Client::find($value)?->fullname),
                Forms\Components\Select::make('client_type')
                    ->options([
                        'petitioner',
                        'respondent'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('respondent_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('respondent_advocate')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('client.fullname')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
