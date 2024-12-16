<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Models\Component;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('الاسم')
                ->required()
                ->columnSpanFull(),
            FileUpload::make('image')
            ->image()
            ->imageEditor()
            ->disk('public')
            ->directory('components')
            ,
            RichEditor::make('description')
            ->columnSpanFull()
                ->label('الوصف')
                ->required(),

            TextInput::make('price')
                ->label('السعر')
                ->numeric()
                ->required(),

            TextInput::make('dimensions')
                ->label('الابعاد')
                ->required(),

            TextInput::make('price_per_unit')
                ->label('سعر الوحده')
                ->numeric()
                ->required(),
            Select::make('material_id')
            ->relationship('material','name')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('الاسم'),
                TextColumn::make('description')
                ->label('الوصف'),
                ImageColumn::make('image')
                ->label('صورة المنتج')
                ->disk('public')
                ->circular()
                ,
                TextColumn::make('price')
                ->label('السعر')
                ->numeric(),
                TextColumn::make('dimensions')
                ->label('الابعاد'),
                TextColumn::make('price_per_unit')
                ->label('سعر الوحده')
                ->numeric(),

                //
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
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
