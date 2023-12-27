<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Product';
    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                    Forms\Components\KeyValue::make('key_featured')
                    ->label('Key featured')
                    ->addActionLabel('Add key')
                    ->keyPlaceholder('Key featured')
                    ->valueLabel('featured_ingredients')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('home_description')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('benefits')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),

                // Forms\Components\RichEditor::make('key_featured')
                //     ->required()
                //     ->columnSpanFull(),

                Forms\Components\RichEditor::make('featured_ingredients')
                    ->required()
                    ->columnSpanFull(),
                    Forms\Components\FileUpload::make('home_image')
                    ->image(),
                    Forms\Components\FileUpload::make('gallery_image')
                 ->multiple()
                    ->required(),
                    Forms\Components\FileUpload::make('preview_image')
                    ->image(),

                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('home_image'),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'view' => Pages\ViewProduct::route('/{record}'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([

            Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('price')
                ->prefix('$'),
                Infolists\Components\TextEntry::make('key_featured')
                ->label('Key featured')
               ,
               Infolists\Components\TextEntry::make('size'),
                Infolists\Components\TextEntry::make('home_description')
                ->columnSpanFull(),

                Infolists\Components\TextEntry::make('benefits')
                ->columnSpanFull(),
                Infolists\Components\TextEntry::make('description')
                ->columnSpanFull(),

            Infolists\Components\TextEntry::make('featured_ingredients')
                ->columnSpanFull(),
                Infolists\Components\ImageEntry::make('home_image'),
                Infolists\Components\ImageEntry::make('gallery_image')
             ,


        ]);
    }
}
