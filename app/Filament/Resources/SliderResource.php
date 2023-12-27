<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
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

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Slider';
    protected static ?string $navigationGroup = 'Pages';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                Forms\Components\RichEditor::make('title')
                ->columnSpanFull(),
                Forms\Components\RichEditor::make('text')
                ->label('description')
                ->columnSpanFull(),
                Forms\Components\FileUpload::make('images')
                ->multiple()
                ->required(),
                Forms\Components\Radio::make('page')
                ->options([
                    'home' => 'home',
                    'first' => 'first',
                    'second' => 'second',
                  'third' => 'third'
                  ,'four' => 'four'
                  ,'five' => 'five',
                  'six' => 'six'

                ])->inline()
                ->default('home')
                ->required()
                ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('text')
                ->label('description')
                ->searchable(),
                Tables\Columns\ImageColumn::make('images')
                ->disk('public'),

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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'view' => Pages\ViewSlider::route('/{record}'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('page'),
                Infolists\Components\TextEntry::make('text')->label('Title'),
                Infolists\Components\TextEntry::make('description')->label('description'),
                Infolists\Components\ImageEntry::make('images')
            ]);
    }
}
