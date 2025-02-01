<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Group::make()->schema([
                        Section::make('Создание продукта')->schema([
                            TextInput::make('name')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->required()
                                ->placeholder('Кто такой сигмабой?')
                                ->label('Название поста'),
                            TextInput::make('slug')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->unique(Product::class, 'slug', fn($record) => $record)
                                ->label('URL'),
                            Textarea::make('description')
                                ->label('Описание продукта')
                                ->required()
                                ->columnSpanFull(),
                            FileUpload::make('image')
                                ->image()
                                ->imageEditor()
                                ->directory('product')
                                ->label('Изображение продукта')
                                ->columnSpanFull()
                                ->required(),
                        ])->columns(2)->columnSpan(2),
                        Section::make('')->schema([
                            TextInput::make('price')
                                ->integer()
                                ->label('Стоимость')
                                ->maxLength(8)
                                ->placeholder('999')
                                ->prefix('₽'),
                            ColorPicker::make('color')
                                ->label('Цвет продукта')
                                ->placeholder('#2d8f85'),
                            TextInput::make('weight')
                                ->label('Вес продукта')
                                ->placeholder('1000')
                                ->maxLength(8)
                                ->suffix('г.'),
                            TextInput::make('material')
                            ->label('Материал продукта')
                            ->placeholder('Материал')
                        ])->columns(4)->columnSpan(2),
                    ])->columnSpan(2),
                    Group::make()->schema([
                        Section::make()->schema([
                            Select::make('brand_id')
                                ->required()
                                ->preload()
                                ->searchable()
                                ->label('Бренд')
                                ->relationship('brand', 'name')
                        ]),
                        Section::make()->schema([
                            Toggle::make('is_active')
                                ->label('Активный продукт'),
                            Toggle::make('is_popular')
                                ->label('Популярный продукт'),
                            Toggle::make('is_sale')
                                ->label('Участвует в акции'),
                            Toggle::make('is_new')
                                ->label('Новинка')
                        ])
                    ])->columnSpan(1)
                ])->columns(3)->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Продукт')
                    ->description(fn (Product $record): string => $record->description),
                ImageColumn::make('image')
                    ->label('Изображение')
                    ->size(50),
                TextColumn::make('price')
                    ->label('Стоимость')
                    ->money('RUB'),
                ColorColumn::make('color')
                    ->label('Цвет')
                    ->copyable(),
                TextColumn::make('weight')
                    ->label('Вес')
                    ->suffix('г'),
                TextColumn::make('material')
                    ->label('Материал')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
