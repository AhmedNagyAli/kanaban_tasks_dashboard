<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            RichEditor::make('description'),
            DateTimePicker::make('started_at'),
            DateTimePicker::make('end_date'),
            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('المنشئ')
                ->default(auth()->id())
                ->disabled(),
            Select::make('task_user')
                ->relationship('user', 'name')
                ->label('المستخدم'),

            Select::make('status')
                    ->options([
                        'complete' => 'Complete',
                        'waiting' => 'Waiting',
                        'problem' => 'Problem',
                        'ideas' => 'Ideas',
                        'under_execution' => 'Under Execution',
                    ])
                    ->required(),
                    Section::make([
                        Repeater::make('category')
                        ->relationship('category')
                        ->schema([
                            TextInput::make('name')
                                ->label('Component Name')
                                ->required(),
                                Textarea::make('description')
                                ->label('description')
                                ->required(),
                        ])
                    
                        ->minItems(1)
                        ->maxItems(10),
                    ])
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Task Name')
                    ->searchable(),
                    
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->html(),
                    
                TextColumn::make('user.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('taskUser.name') // assuming task_user is a user relationship
                    ->label('Assigned To')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('started_at')
                    ->label('Start Date')
                    ->dateTime(),
                    
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->dateTime(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    
                    ->colors([
                        'success' => 'complete',
                        'danger' => 'problem',
                        'warning' => 'waiting',
                        'info' => 'ideas',
                        'primary' => 'under_execution',
                    ]),
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
