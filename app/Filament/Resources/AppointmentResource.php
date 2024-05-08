<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\CaseItem;
use App\Models\Client;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'md' => 12,
                    ])
                    ->schema([
                        Select::make('client_id')
                            ->columnSpan(['md' => 4])
                            ->relationship('client', 'name')
                            ->required()
                            ->label('Clients')
                            ->searchable()
                            ->options(function () {
                                return Client::whereHas('team', function ($q) {
                                    $q->whereIn('team_id', Filament::getTenant());
                                })->get()
                                    ->map(function ($value) {
                                        return ['fullname' => $value->fullname, 'id' => $value->id];
                                    })->pluck('fullname', 'id');
                            }),
                        TextInput::make('phone_no')
                            ->columnSpan(['md' => 4]),
                        DateTimePicker::make('appointment_date')
                            ->columnSpan(['md' => 4]),
                        Select::make('status')
                            ->columnSpan(['md' => 4])
                            ->options([
                                'open' => 'Open',
                                'close' => 'Close',
                                'on-going' => 'On-going',
                                're-schedule' => 'Re-schedule',
                                'unattended' => 'Unattended'
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.fullname'),
                TextColumn::make('phone_no'),
                TextColumn::make('appointment_date')->date('F j, Y - H:iA'),
                TextColumn::make('status'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
