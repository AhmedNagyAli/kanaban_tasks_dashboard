<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Actions\CreateAction;

class TaskKanbanBoard extends KanbanBoard
{
    protected static string $model = Task::class;
    protected static string $statusEnum = TaskStatus::class;
    protected string $editModalTitle = 'Tasks Dashboard';
     
    protected string $editModalSaveButtonLabel = 'Save';
    protected string $editModalWidth = '5xl';
 
    protected string $editModalCancelButtonLabel = 'Cancel';
    protected static string $recordTitleAttribute = 'name';  
    protected static string $recordStatusAttribute = 'status';
    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('name'),
            RichEditor::make('description'),
            DateTimePicker::make('started_at'),
            DateTimePicker::make('end_date'),
            Select::make('user_id')
                ->label('المنشئ')
                ->default(auth()->id())
                ->disabled(),
            Select::make('task_user')
                ->relationship('user', 'name')
                ->label('المستخدم'),
                Section::make([
                    Repeater::make('comment')
                    ->relationship('comment')
                    ->schema([
                        Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('المنشئ')
                        ->default(auth()->id()),
                        Select::make('task_id')
                        ->label('التاسك')
                        ->default(fn (?Task $record) => $record ? $record->id : null) 
                        ->disabled(),
                        TextInput::make('title')
                            ->label('title')
                            ->required(),
                            Textarea::make('comment')
                            ->label('comment')
                            ->required(),
                    ])
                
                    ->minItems(1)
                    ->maxItems(10),
                    ]),
            // Section::make([
            //     TextInput::make('category.name'),
            //     TextInput::make('category.description'),
            // ])->label('عنوان فرعي'),
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
            // Section::make([
            //     Repeater::make('category')
            //     ->relationship('category')
            //     ->schema([
            //         TextInput::make('name')
            //             ->label('Name')
            //             ->required(),
            //             Textarea::make('description')
            //             ->label('description')
            //             ->required(),
            //     ])
            
            //     ->minItems(1)
            //     ->maxItems(10),
            // ])
            
            
    
        ];
    }
    protected function getHeaderActions():array
    {
        return [
            CreateAction::make('Create Task')
            ->model(Task::class)
            ->form([
                TextInput::make('name'),
            RichEditor::make('description'),
            DateTimePicker::make('started_at'),
            DateTimePicker::make('end_date'),
            Select::make('user_id')
                ->label('المنشئ')
                ->default(auth()->id())
                ->relationship('user', 'name'),
            Select::make('task_user')
                ->relationship('user', 'name')
                ->label('المستخدم'),
            Section::make([
                    Repeater::make('category')
                        ->relationship('category')
                        ->schema([
                            TextInput::make('name')
                                ->label(' Name')
                                ->required(),
                                Textarea::make('description')
                                ->label('description')
                                ->required(),
                        ])
                    
                        ->minItems(1)
                        ->maxItems(10),
                // TextInput::make('category.name'),
                // TextInput::make('category.description'),
                
            ])->label('عنوان فرعي'),
            Section::make([
                Repeater::make('comment')
                ->relationship('comment')
                ->schema([
                    TextInput::make('title')
                        ->label('Component Name')
                        ->required(),
                        Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('المنشئ')
                        ->default(auth()->id())
                        ->disabled(),
                        Textarea::make('comment')
                        ->label('description')
                        ->required(),
                ])
            
                ->minItems(1)
                ->maxItems(10),
                ]),
            Select::make('status')
                    ->options([
                        'complete' => 'Complete',
                        'waiting' => 'Waiting',
                        'problem' => 'Problem',
                        'ideas' => 'Ideas',
                        'under_execution' => 'Under Execution',
                    ])
                    ->required(),

            ]),

        ];
    }


}
