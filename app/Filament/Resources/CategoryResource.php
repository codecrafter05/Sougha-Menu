<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput\Mask; 
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('label_en')->label('Name (EN)')->required()->maxLength(255),
                TextInput::make('label_ar')->label('Name (AR)')->required()->maxLength(255),
                TextInput::make('slug')->label('Slug')->disabled()->dehydrated(false),
                FileUpload::make('icon_path')
                    ->label('Icon')
                    ->image()
                    ->disk('public')
                    ->directory('categories/icons')
                    ->imageEditor()
                    ->required(false),
                Toggle::make('is_active')->label('Active')->default(true),
                TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon_path')->label('Icon')->disk('public'),
                TextColumn::make('label_en')->label('EN')->searchable()->sortable(),
                TextColumn::make('label_ar')->label('AR')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean()->label('Active')->sortable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
