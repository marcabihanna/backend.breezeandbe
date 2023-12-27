<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageComponentResource\Pages;
use App\Filament\Resources\PageComponentResource\RelationManagers;
use App\Models\PageComponent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class PageComponentResource extends Resource
{
    protected static ?string $model = PageComponent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Page Component';
     protected static ?string $navigationGroup = 'Pages';
     protected static ?int $navigationSort = 2;
//
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Card::make()->schema([
                Forms\Components\TextInput::make('slug')->required(),
                Forms\Components\TextInput::make('title_description')->required()->label('Title'),
                Forms\Components\RichEditor::make('description')->required()->columnSpanFull(),
                Forms\Components\RichEditor::make('description2')->columnSpanFull(),
                Forms\Components\FileUpload::make('image'),
                Forms\Components\FileUpload::make('video'),
                Forms\Components\TextInput::make('button_url'),
                Forms\Components\RichEditor::make('button_text'),
                Forms\Components\Radio::make('page')
                ->options([
                    'home' => 'home',
                    'first' => 'first',
                    'second' => 'second',
                  'third' => 'third',
                  'four' => 'four',
                  'five' => 'five',
                  'six' => 'six'

                ])->inline()
                ->default('home')
                ->required()
                  ->columnSpanFull()
                ,

                ])->columns(2)

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('slug')
                ->searchable(),
                Tables\Columns\TextColumn::make('title_description')
                ->label('Title')
                ->searchable(),
                Tables\Columns\TextColumn::make('button_url'),
                Tables\Columns\TextColumn::make('button_text'),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListPageComponents::route('/'),
            'create' => Pages\CreatePageComponent::route('/create'),
            'view' => Pages\ViewPageComponent::route('/{record}'),
            'edit' => Pages\EditPageComponent::route('/{record}/edit'),
        ];
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('page'),
                Infolists\Components\TextEntry::make('title_description')->label('Title'),
                Infolists\Components\TextEntry::make('description')->label('description'),
                Infolists\Components\TextEntry::make('description2')->label('description'),
                Infolists\Components\ImageEntry::make('image'),
                Infolists\Components\ImageEntry::make('video'),

                Infolists\Components\TextEntry::make('button_url')->label('button url'),
                Infolists\Components\TextEntry::make('button_text')->label('button text'),

            ]);
    }
}
