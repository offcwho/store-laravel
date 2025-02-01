<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Создание бренда')->schema([
                    TextInput::make('name')
                        ->label('Название бренда')
                        ->placeholder('Это тебе ни какая-нибудь авоська, это фирма собачини')
                        ->maxLength(255)
                        ->required(),
                    FileUpload::make('image')
                        ->image()
                        ->imageEditor()
                        ->directory('brand')
                        ->label('Логотип бренда')
                        ->columnSpanFull()
                        ->required(),
                    Fieldset::make('Опции')->schema([
                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Активный бренд'),
                        Toggle::make('is_popular')
                            ->default(false)
                            ->label('Популярный бренд'),
                    ])
                ])->columns(['sm' => 2])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Бренд'),
                ImageColumn::make('image')
                    ->label('Логотип')
                    ->size(46)
                    ->circular(),
                ToggleColumn::make('is_popular')
                    ->label('Популярный бренд'),
                ToggleColumn::make('is_active')
                    ->label('Активный бренд'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->label('Дата создания'),
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
