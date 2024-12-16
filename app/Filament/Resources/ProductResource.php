<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ComponentsRelationManager;
use App\Models\Component;
use App\Models\Material;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make([
                TextInput::make('name')
                ->label('اسم المنتج')
                ->required()
                ->columnSpanFull(),
            FileUpload::make('image')
            ->image()
            ->imageEditor()
            ->disk('public')
            ->directory('products-pics')
            ,
        
                RichEditor::make('description')
                ->columnSpanFull()
                    ->label('الوصف')
                    ->required()
                    ,

            TextInput::make('quantity')
                ->label('الكمية')
                ->numeric()
                ->required(),

            TextInput::make('sell_price')
                ->label('سعر البيع')
                ->numeric()
                ->required(),
            ])->collapsible(),
           
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('اسم المنتج'),
                ImageColumn::make('image')
                ->label('صورة المنتج')
                ->disk('public')
                ->circular()
                ,
                TextColumn::make('description'),
                TextColumn::make('quantity')
                ->numeric(),
                TextColumn::make('sell_price')
                ->label('سعر البيع')
                ->numeric(),
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
            ComponentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
