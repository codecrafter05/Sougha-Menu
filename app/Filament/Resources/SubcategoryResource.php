<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\RelationManagers;
use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Models\Category;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->options(fn () => Category::orderBy('label_en')->pluck('label_en', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('label_en')->label('Name (EN)')->required()->maxLength(255),
                TextInput::make('label_ar')->label('Name (AR)')->required()->maxLength(255),
                TextInput::make('slug')->label('Slug')->disabled()->dehydrated(false),
                Toggle::make('is_active')->label('Active')->default(true),
                TextInput::make('sort_order')->numeric()->default(0)->label('Sort Order'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.label_en')->label('Category')->sortable()->searchable(),
                TextColumn::make('label_en')->label('EN')->sortable()->searchable(),
                TextColumn::make('label_ar')->label('AR')->sortable()->searchable(),
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
            'index' => Pages\ListSubcategories::route('/'),
            'create' => Pages\CreateSubcategory::route('/create'),
            'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }
}
