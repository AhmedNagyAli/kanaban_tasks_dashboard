<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentsRelationManager extends RelationManager
{
    protected static string $relationship = 'components';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                        ->label('Component Name')
                        ->required(),
                        Textarea::make('description')
                        ->label('description')
                        ->required(),
                        TextInput::make('price') 
                        ->label('Component Price')
                        ->numeric(),
                        
                    TextInput::make('dimensions')
                        ->label('Component Dimensions'),
                        TextInput::make('name')
                        ->label('Component Name')
                        ->required(),
                    TextInput::make('quantity_per_product')
                        ->label('Quantity per Product')
                        ->numeric()
                        ->required(),
                    Select::make('material_id')
                            ->relationship('material', 'name')
                            ->label('Material'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('price_per_unit')
            ->columns([
                Tables\Columns\TextColumn::make('price_per_unit'),
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
