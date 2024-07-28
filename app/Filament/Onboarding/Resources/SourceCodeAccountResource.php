<?php

namespace App\Filament\Onboarding\Resources;

use App\Filament\Onboarding\Resources\SourceCodeAccountResource\Pages;
use App\Filament\Onboarding\Resources\SourceCodeAccountResource\RelationManagers;
use App\Models\SourceCodeAccount;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SourceCodeAccountResource extends Resource
{
    protected static ?string $model = SourceCodeAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('provider')
                    ->badge()
                    ->color('primary'),

            ])
            ->filters([
                //
            ])
            ->actions([
                //
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
            'index' => Pages\ListSourceCodeAccounts::route('/'),
        ];
    }
}
