<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Coupon;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Order';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->label('Total price')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('total_price_new')
                    ->required()
                    ->label('Price after Discount')
                    ->numeric()
                    ->prefix('$'),

                    Select::make('coupon_id')
                   ->label('Coupon')
                    ->options(Coupon::all()->pluck('code','id')->toArray()),
                Forms\Components\Toggle::make('status')
                   ->label('Complete')
                    ->required(),
                // Forms\Components\Toggle::make('delivered')
                //     ->required(),
                // Forms\Components\Toggle::make('in_progress')
                //     ->required(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money()
                    ->label('Total Price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price_new')
                    ->money()
                    ->label('Price after Discount')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                ->label('Complete'),
                // Tables\Columns\ToggleColumn::make('in_progress'),
                // Tables\Columns\ToggleColumn::make('delivered'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                    // ->toggleable(isToggledHiddenByDefault: true),
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [

            RelationManagers\OrderDetailRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
