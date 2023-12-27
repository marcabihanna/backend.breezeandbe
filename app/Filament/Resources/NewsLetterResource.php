<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsLetterResource\Pages;
use App\Filament\Resources\NewsLetterResource\RelationManagers;
use App\Models\NewsLetter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;

class NewsLetterResource extends Resource
{
    protected static ?string $model = NewsLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Subscribers';
    protected static ?string $navigationGroup = 'NwesLetter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(255),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                ->searchable(),
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
                // Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListNewsLetters::route('/'),
            'create' => Pages\CreateNewsLetter::route('/create'),
            'view' => Pages\ViewNewsLetter::route('/{record}'),
            'edit' => Pages\EditNewsLetter::route('/{record}/edit'),
        ];
    }
}
