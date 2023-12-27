<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactDetailResource\Pages;
use App\Filament\Resources\ContactDetailResource\RelationManagers;
use App\Models\ContactDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactDetailResource extends Resource
{
    protected static ?string $model = ContactDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?string $navigationLabel = 'Contact Details';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('phone2')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('facebook')
                    ->maxLength(255),
                Forms\Components\TextInput::make('you_tube')
                    ->label('youTube')
                    ->maxLength(255),
                Forms\Components\TextInput::make('instagram')
                    ->url(),
                    // ->prefixIcon('heroicon-s-external-link')
                    // ->suffixIcon('heroicon-s-globe'),
                Forms\Components\TextInput::make('tik_tok')
                ->label('tikTok')
                    ->maxLength(255),
                Forms\Components\TextInput::make('linked_in')
                ->label('linkedIn')
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
                Tables\Columns\TextColumn::make('phone2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable(),
                Tables\Columns\TextColumn::make('you_tube')
                   ->label('youTube')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tik_tok')
                ->label('tikTok')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linked_in')
                ->label('linkedIn')
                    ->searchable(),
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
            'index' => Pages\ListContactDetails::route('/'),
            'create' => Pages\CreateContactDetail::route('/create'),
            'view' => Pages\ViewContactDetail::route('/{record}'),
            'edit' => Pages\EditContactDetail::route('/{record}/edit'),
        ];
    }
}
