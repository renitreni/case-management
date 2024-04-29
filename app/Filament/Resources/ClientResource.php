<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(12)
            ->schema([
                TextInput::make('first_name')->columnSpan(4),
                TextInput::make('middle_name')->columnSpan(4),
                TextInput::make('last_name')->columnSpan(4),
                Select::make('gender')
                    ->columnSpan(4)
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                TextInput::make('email')->columnSpan(5),
                TextInput::make('phone_no')->columnSpan(4),
                TextInput::make('phone_no_other')->columnSpan(4),
                Textarea::make('address')->columnSpan(12),
                TextInput::make('city')->columnSpan(4),
                TextInput::make('state')->columnSpan(4),
                TextInput::make('country')->columnSpan(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->sortable(),
                TextColumn::make('last_name')->sortable(),
                TextColumn::make('email')->sortable(),
                TextColumn::make('phone_no')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('View Client'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Details')
                            ->columns(12)
                            ->schema([
                                TextEntry::make('first_name')->columnSpan(4),
                                TextEntry::make('middle_name')->columnSpan(4),
                                TextEntry::make('last_name')->columnSpan(4),
                                TextEntry::make('gender'),
                                TextEntry::make('email')->columnSpan(8),
                                TextEntry::make('phone_no')->columnSpan(4)->label('Primary Phone No.'),
                                TextEntry::make('phone_no_other')->columnSpan(6)->label('Alternative Phone No.'),
                                TextEntry::make('address')->columnSpan(12),
                                TextEntry::make('city')->columnSpan(4),
                                TextEntry::make('state')->columnSpan(4),
                                TextEntry::make('country')->columnSpan(4),
                            ]),
                        Tab::make('Cases')
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Account')
                            ->schema([
                                // ...
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
