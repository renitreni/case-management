<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers\ClientsRelationManager;
use App\Models\CaseItem;
use App\Models\CaseStatus;
use App\Models\CaseSubType;
use App\Models\CaseType;
use App\Models\CourtType;
use App\Models\JudgeType;
use DateTime;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
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
                Section::make()->schema([
                    Radio::make('Priority')
                        ->options([
                            'high' => 'High',
                            'medium' => 'Medium',
                            'low' => 'Low'
                        ])
                        ->label('Case Priority')
                        ->inlineLabel(false)
                        ->inline(),
                ]),
                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->columns([
                        'md' => 3
                    ])
                    ->tabs([
                        Tabs\Tab::make('Case Detail')
                            ->schema([
                                TextInput::make('case_no')->columnSpan(['md' => 1])->required(),
                                Select::make('case_type_id')
                                    ->required()
                                    ->label('Case Type')
                                    ->options(CaseType::filterByTenant()->pluck('name', 'id'))
                                    ->columnSpan(['md' => 1])
                                    ->reactive(),
                                Select::make('case_sub_type_id')
                                    ->required()
                                    ->label('Case Sub-type')
                                    ->options(function (callable $get) {
                                        return CaseSubType::where('case_type_id', $get('case_type_id'))
                                            ->pluck('name', 'id');
                                    })
                                    ->columnSpan(['md' => 1]),
                                Select::make('case_status_id')
                                    ->columnSpan(['md' => 1])
                                    ->required()
                                    ->label('Stage Of Case')
                                    ->options(CaseStatus::filterByTenant()->pluck('name', 'id')),
                                TextInput::make('act')->columnSpan(['md' => 1])->required(),
                                DatePicker::make('filing_date')->columnStart(['md' => 1])->required(),
                                TextInput::make('filing_no')->columnSpan(['md' => 1])->required(),
                                DatePicker::make('registration_date')->label('Registration Date')->columnStart(['md' => 1])->required(),
                                TextInput::make('registration_no')->label('Registration No.')->columnSpan(['md' => 1])->required(),
                                DatePicker::make('first_hearing_date')->label('First Hearing Date')->columnStart(['md' => 1])->required(),
                                TextInput::make('cnr_no')->label('CNR No.')->columnSpan(['md' => 1])->required(),
                                Textarea::make('description')->columnSpanFull()
                            ]),
                        Tabs\Tab::make('First Information Report Detail')
                            ->schema([
                                TextInput::make('police_station')->columnSpan(['md' => 3])->required(),
                                TextInput::make('fir_no')->columnSpan(['md' => 1])->required(),
                                DatePicker::make('fir_date')->columnSpan(['md' => 1])->required(),
                            ]),
                        Tabs\Tab::make('Court Detail')
                            ->schema([
                                Select::make('judge_type_id')
                                    ->required()
                                    ->label('Judge Type')
                                    ->reactive()
                                    ->options(JudgeType::filterByTenant()->pluck('name', 'id')),
                                TextInput::make('judge_name')->label('Judge Name')->columnSpan(['md' => 1])->required(),
                                TextInput::make('court_no')->label('Court No.')->columnStart(['md' => 1])->required(),
                                Select::make('court_type_id')
                                    ->required()
                                    ->label('Court Type')
                                    ->reactive()
                                    ->options(CourtType::filterByTenant()->pluck('name', 'id')),
                                Textarea::make('remarks')->columnSpanFull()
                            ]),
                    ])
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
