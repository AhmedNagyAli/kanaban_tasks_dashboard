<?php

namespace App\Filament\Resources\ComponentRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Component Name')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Component Price')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dimensions')
                    ->label('Dimensions'),

                Forms\Components\TextInput::make('quantity_per_product')
                    ->label('Quantity per Product')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('material_id')
                    ->relationship('material', 'name')
                    ->label('Material')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
