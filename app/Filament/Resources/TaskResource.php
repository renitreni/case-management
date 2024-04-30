<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\CaseItem;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'md' => 12,
                    ])
                    ->schema([
                        Radio::make('priority')
                            ->required()
                            ->columnStart(['md' => 1])
                            ->columnSpan(['md' => 8])
                            ->inline()
                            ->options([
                                'high' => 'High',
                                'medium' => 'Medium',
                                'low' => 'Low',
                            ])
                            ->label('Task Priority')
                            ->inlineLabel(false)
                            ->inline(),
                        Radio::make('status')
                            ->required()
                            ->columnStart(['md' => 1])
                            ->columnSpan(['md' => 8])
                            ->inline()
                            ->options([
                                'completed' => 'Completed',
                                'in progress' => 'In Progress',
                                'not started' => 'Not Started',
                            ])
                            ->label('Task Status')
                            ->inlineLabel(false)
                            ->inline(),
                        TextInput::make('task_name')
                            ->columnStart(['md' => 1])->required()->columnSpan(['md' => 6]),
                        Select::make('case_item_id')
                            ->required()
                            ->columnSpan(['md' => 6])
                            ->label('Case')
                            ->options(CaseItem::filterByTenant()->pluck('case_no', 'id'))
                            ->searchable(),
                        DatePicker::make('start_date')
                            ->reactive()
                            ->columnSpan(['md' => 4])
                            ->required(),
                        DatePicker::make('end_date')
                            ->columnSpan(['md' => 4])
                            ->required()
                            ->minDate(function (callable $get, callable $set) {
                                $eventDate = $get('start_date');
                                if (Carbon::parse($get('start_date'))->greaterThan($get('end_date'))) {
                                    $set('end_date', '');
                                }

                                if ($eventDate != null) {
                                    return Carbon::parse($eventDate)->addDay()->format('Y-m-d');
                                }
                                return null;
                            }),
                        Select::make('members')
                            ->relationship('members', 'first_name')
                            ->required()
                            ->columnSpan(['md' => 8])
                            ->label('Members')
                            ->searchable()
                            ->multiple()
                            ->options(User::whereHas('teams', function ($q) {
                                $q->whereIn('team_id', Filament::getTenant());
                            })
                                ->pluck('name', 'id')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task_name')->sortable(),
                TextColumn::make('case.case_no')->sortable(),
                TextColumn::make('start_date')->sortable()->date('F j, Y'),
                TextColumn::make('end_date')->sortable()->date('F j, Y'),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'in progress' => 'info',
                        'not started' => 'gray',
                    })
                    ->sortable(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
